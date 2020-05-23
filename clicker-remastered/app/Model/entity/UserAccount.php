<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Nette\Security\IIdentity;
use App\Model\Base\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Model\Entities\UnsignedIdentifier;

/**
 * @ORM\Entity
 * @ORM\Table(name="register")
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

    public function getRoles()
    {
        return ['']; // todo
    }
    
}
