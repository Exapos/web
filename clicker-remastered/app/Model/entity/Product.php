<?php

declare(strict_types=1);

namespace App\Model\Entity;

use App\Model\Base\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Model\Entities\UnsignedIdentifier;

/**
 * @ORM\Entity
 */
class Product extends BaseEntity
{

    use UnsignedIdentifier;

    /** @ORM\Column(type="string") */
    public $namePublic;

    /** @ORM\Column(type="string") */
    public $namePrivate;

    /** @ORM\Column(type="integer") */
    public $perSecondGenerate;

    /** @ORM\Column(type="integer") */
    public $perSecondExtendedClick;

    /** @ORM\Column(type="integer") */
    public $price;

    /** @ORM\Column(type="integer") */
    public $increasment;

    /** @ORM\Column(type="integer") */
    public $perSecondMultiplier;

    /** @ORM\Column(type="string") */
    public $image;

    public $count = 0;
}
