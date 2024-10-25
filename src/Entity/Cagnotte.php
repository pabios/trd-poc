<?php

namespace App\Entity;

use App\Repository\CagnotteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CagnotteRepository::class)]
class Cagnotte extends  BaseEntity
{

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $solde = null;

    #[ORM\ManyToOne(inversedBy: 'cagnottes')]
    private ?User $user = null;

    /**
     * @var Collection<int, Transaction>
     */
    #[ORM\OneToMany(targetEntity: Transaction::class, mappedBy: 'cagnotte')]
    private Collection $transactions;

    public function __construct()
    {
        $this->solde = 0;
        $this->transactions = new ArrayCollection();
    }

    public function getSolde(): ?string
    {
        return $this->solde;
    }

    public function setSolde(string $solde): static
    {
        $this->solde = $solde;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

//    public function addTransaction(Transaction $transaction): static
//    {
//        if (!$this->transactions->contains($transaction)) {
//            $this->transactions->add($transaction);
//            $transaction->setCagnotte($this);
//        }
//
//        return $this;
//    }

// Ajoute une transaction et modifie le solde en fonction du type de mouvement
    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setCagnotte($this);

            // Met à jour le solde de la cagnotte
            if ($transaction->getType() === 'deposit') {
                $this->solde += $transaction->getMontant();
            } elseif ($transaction->getType() === 'bet') {
                $this->solde -= $transaction->getMontant();  // Soustraction si c'est un pari
            }
        }
        return $this;
    }

    public function removeTransaction(Transaction $transaction): static
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getCagnotte() === $this) {
                $transaction->setCagnotte(null);
            }
        }

        return $this;
    }
}
