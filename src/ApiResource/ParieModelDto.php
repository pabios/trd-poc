<?php

namespace App\ApiResource;

use Symfony\Component\Validator\Constraints as Assert;

class ParieModelDto
{
    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    #[Assert\Choice(choices: [1, 2, 0], message: "Choix doit être 1 (Victoire 1), 2 (Victoire 2) ou 0 (Égalité).")]
    public int $choix;

    #[Assert\NotBlank]
    #[Assert\Type('float')]
    #[Assert\GreaterThan(value: 0, message: "La mise doit être un montant supérieur à 0.")]
    public float $mise;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public string $rencontre;


}