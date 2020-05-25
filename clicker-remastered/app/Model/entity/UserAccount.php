<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Nette\Security\IIdentity;
use App\Model\Base\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Model\Entities\UnsignedIdentifier;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_account")
 */
class UserAccount extends BaseEntity implements IIdentity
{

    use UnsignedIdentifier;

    /** @ORM\Column(type="string") */
    public $password;

    /** @ORM\Column(type="string") */
    public $username;

    /** @ORM\Column(type="string") */
    public $cookie;

    /** @ORM\Column(type="string") */
    public $email;

    /** @ORM\Column(type="integer") */
    public $money;

    /** @ORM\OneToMany(targetEntity="InventoryItem", mappedBy="userAccount", cascade={"persist", "remove"}) */
    public $inventoryItems;

    /** @ORM\Column(type="datetime", nullable=true) */
    public $perSecondGenerateLastCheck;

    /** @ORM\Column(type="integer") */
    public $perSecondGenerateAmount = 0;

    public function getRoles()
    {
        return [''];
    }

    public function addMoney($amount)
    {
        $this->money += $amount;
    }

    public function getInventoryItemBySlug($slug)
    {
        foreach ($this->inventoryItems as $inventoryItem) {
            if ($inventoryItem == $slug) {
                return $inventoryItem;
            }
        }

        return null;
    }
}
