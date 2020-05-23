<?php

namespace App\Model\Base;

use Doctrine\Common\Collections\Collection;

/**
 * Class BaseEntity
 * @package Core\Model\Entity
 *
 * @property-read mixed $id
 */
abstract class BaseEntity
{


    /**
     * BaseEntity constructor.
     * @internal only service classes should create new instance
     */
    public function __construct()
    {
    }

    public abstract function getId();

    public function toArray()
    {
        $array = [];
        foreach ($this as $field => $value) {
            if ($value instanceof BaseEntity) {
                $value = $value->getId();
            } else if ($value instanceof Collection) {
                $value = array_map(function (BaseEntity $entity) {
                    return $entity->getId();
                }, $value->toArray());
            }
            if ($value === false || $value === true) {
                $array[$field] = $value ? 1 : 0;
            } else {
                $array[$field] = $value;
            }
        }
        return $array;
    }

    public function toArrayNew(BaseEntity $parent = null)
    {
        $magicProperties = ['__initializer__', '__cloner__', '__isInitialized__'];

        $array = [];
        foreach ($this as $field => $value) {
            if (in_array($field, $magicProperties)) {
                continue;
            }

            if ($value instanceof BaseEntity) {
                if ($value === $parent) {
                    continue;
                }

                $array[$field] = $value->toArrayNew($this);

                continue;
            }

            if ($value instanceof Collection) {
                $collectionItems = $value->toArray();

                $array[$field] = [];
                /** @var BaseEntity $collectionItem */
                foreach ($collectionItems as $collectionItem) {
                    $array[$field][] = $collectionItem->toArrayNew($this);
                }

                continue;
            }

            if ($value instanceof BaseEmbeddable) {
                $array[$field] = $value->toArrayNew($this);

                continue;
            }

            if ($value instanceof DateTimeInterface) {
                $array[$field] = (array) $value;

                continue;
            }

            $array[$field] = $value;
        }

        return $array;
    }
}
