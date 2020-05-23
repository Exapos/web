<?php

namespace App\Model\Base;

use Doctrine\Common\Persistence\ObjectRepository;
use Kdyby\Doctrine\EntityDao;
use Kdyby\Doctrine\EntityManager;
use Kdyby\Doctrine\EntityRepository;
use Nette\SmartObject;

/**
 * Class BaseDao
 * @method onUpdated(BaseEntity [] $updated)
 * @method onDeleted(BaseEntity [] $deleted)
 */
abstract class BaseDoctrineService
{

    use SmartObject;

    /** @var callback[] */
    public $onUpdated = [];

    /** @var callback[] */
    public $onDeleted = [];

    /** @var EntityManager */
    protected $em;

    /** @var EntityRepository */
    protected $repository;

    private $scheduleUpdate = [];

    private $scheduleDelete = [];

    /**
     * @param EntityManager $em
     * @param EntityDao|EntityRepository|ObjectRepository $repository
     */
    public function __construct(EntityManager $em, $repository = null)
    {
        $this->em = $em;
        $this->repository = $repository;
    }

    //////////////////////////////////////////////////////// EM based

    public function save($entity)
    {
        $this->saveDelayed($entity);
        $this->flushAll();

        return $entity;
    }

    public function saveDelayed($entity)
    {
        $this->em->persist($entity);
        $this->scheduleUpdate[] = $entity;

        return $entity;
    }

    public function delete($entity)
    {
        $this->deleteDelayed($entity);
        $this->flushAll();

        return $entity;
    }

    public function deleteDelayed($entity)
    {
        $this->em->remove($entity);
        $this->scheduleDelete[] = $entity;

        return $entity;
    }

    public function flushAll()
    {
        $this->em->flush();

        if (!empty($this->scheduleUpdate)) {
            $this->onUpdated($this->scheduleUpdate);
            $this->scheduleUpdate = [];
        }
        if (!empty($this->scheduleDelete)) {
            $this->onDeleted($this->scheduleDelete);
            $this->scheduleDelete = [];
        }
    }

    ///////////////////// Repository based

    public function find($id = null)
    {
        if (!$id) {
            $id = 0;
        }
        return $this->repository->find($id);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findPairs($criteria, $value = null, $orderBy = [], $key = null)
    {
        return $this->repository->findPairs($criteria, $value, $orderBy, $key);
    }

    public function findBy(array $criteria, array $order = null, $limit = null, $offset = null)
    {
        return $this->repository->findBy($criteria, $order, $limit, $offset);
    }

    public function findOneBy($array)
    {
        return $this->repository->findOneBy($array);
    }

    public function getQueryBuilder($alias = 's')
    {
        return $this->repository->createQueryBuilder($alias);
    }

}
