<?php

declare(strict_types=1);

namespace App\Model\Entity;

use App\Model\Base\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Model\Entities\UnsignedIdentifier;

/**
 * @ORM\Entity
 */
class InventoryItem extends BaseEntity
{

    use UnsignedIdentifier;

    /** @ORM\Column(type="integer") */
    public $count;

    /**
     * @ORM\ManyToOne(targetEntity="UserAccount")
     * @ORM\JoinColumn(name="user_account_id", referencedColumnName="id")
     */
    public $userAccount;

    /**
     * @ORM\OneToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    public $product;
    
}
