<?php

declare (strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;

/**
 * @Entity
 */
class Category
{
    /**
    * @Id()
    * @Column(type="integer")
    * @GeneratedValue()
    */
    private $id;

    /**
     * @Column(length=30)
     */
    private $name;

    /**
     * @Column(length=30)
     */
    private $description;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
