<?php

declare(strict_types=1);

namespace App\Model\Service;

use Kdyby\Doctrine\EntityManager;
use App\Model\Base\BaseDoctrineService;
use App\Model\Entity\UserAccount;

final class UserAccountService extends BaseDoctrineService
{

    public function __construct(EntityManager $em)
    {
        /** @var EntityRepository $repository */
        $repository = $em->getRepository(UserAccount::class);
        parent::__construct($em, $repository);
    }
}
