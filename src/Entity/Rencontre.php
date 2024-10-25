<?php

namespace App\Entity;

use App\Repository\RencontreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RencontreRepository::class)]
class Rencontre extends BaseEntity
{
    #[ORM\Column(length: 100)]
    private ?string $equipe1 = null;

    #[ORM\Column(length: 100)]
    private ?string $equipe2 = null;

    #[ORM\Column]
    private ?float $coteVictoire1 = null;

    #[ORM\Column]
    private ?float $coteVictoire2 = null;

    #[ORM\Column]
    private ?float $coteEgalite = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateMatch = null;


    public function __construct(){
        $this->dateMatch = new \DateTimeImmutable('now');// on assume cela pour l'instant
    }
    public function getEquipe1(): ?string
    {
        return $this->equipe1;
    }

    public function setEquipe1(string $equipe1): static
    {
        $this->equipe1 = $equipe1;

        return $this;
    }

    public function getEquipe2(): ?string
    {
        return $this->equipe2;
    }

    public function setEquipe2(string $equipe2): static
    {
        $this->equipe2 = $equipe2;

        return $this;
    }

    public function getCoteVictoire1(): ?float
    {
        return $this->coteVictoire1;
    }

    public function setCoteVictoire1(float $coteVictoire1): static
    {
        $this->coteVictoire1 = $coteVictoire1;

        return $this;
    }

    public function getCoteVictoire2(): ?float
    {
        return $this->coteVictoire2;
    }

    public function setCoteVictoire2(float $coteVictoire2): static
    {
        $this->coteVictoire2 = $coteVictoire2;

        return $this;
    }

    public function getCoteEgalite(): ?float
    {
        return $this->coteEgalite;
    }

    public function setCoteEgalite(float $coteEgalite): static
    {
        $this->coteEgalite = $coteEgalite;

        return $this;
    }

    public function getDateMatch(): ?\DateTimeInterface
    {
        return $this->dateMatch;
    }

    public function setDateMatch(?\DateTimeInterface $dateMatch): static
    {
        $this->dateMatch = $dateMatch;

        return $this;
    }
}
