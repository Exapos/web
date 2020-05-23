<?php

declare(strict_types = 1);

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @property-read int $id
 */
trait UnsignedIdentifier
{

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", options={"unsigned":true})
	 * @ORM\GeneratedValue
	 * @var int
	 */
	private $id;

	public function getId()
	{
		return $this->id;
	}

	public function __clone()
	{
		$this->id = NULL;
	}

}
