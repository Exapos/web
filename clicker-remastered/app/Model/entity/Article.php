<?php

declare(strict_types=1);

namespace App\Model\Entity;

use App\Model\Base\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Model\Entities\UnsignedIdentifier;

/**
 * @ORM\Entity
 */
class Article extends BaseEntity
{

    use UnsignedIdentifier;

    /** @ORM\Column(type="string") */
    public $header;

    /** @ORM\Column(type="string") */
    public $content;
}
