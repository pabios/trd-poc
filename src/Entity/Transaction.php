<?php

namespace App\Entity;

use App\Domain\Enum\TransactionType;
use App\Repository\TransactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction extends BaseEntity
{
    #[ORM\Column(length: 8)]
    #[Assert\Choice(choices: ['depot', 'retrait', 'pari'], message: 'Choose a valid transaction type.')]
    private ?string $type = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private  $montant;


    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    private ?Cagnotte $cagnotte = null;

    public function getType(): ?TransactionType
    {
        return TransactionType::from($this->type);
    }

    public function setType(TransactionType $type): self
    {
        $this->type = $type->value;
        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param mixed $montant
     */
    public function setMontant($montant): void
    {
        $this->montant = $montant;
    }
    public function getCagnotte(): ?Cagnotte
    {
        return $this->cagnotte;
    }

    public function setCagnotte(?Cagnotte $cagnotte): static
    {
        $this->cagnotte = $cagnotte;

        return $this;
    }
}
