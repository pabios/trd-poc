<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;


class BaseEntity
{
    #[ORM\Id]
    #[ORM\Column(type: "string", length: 36, unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    protected ?string $id = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    protected ?bool $isActif = true;

    public function getIsActif(): ?bool
    {
        return $this->isActif;
    }

    public function setIsActif(?bool $isActif): void
    {
        $this->isActif = $isActif;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

}