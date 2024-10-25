<?php

namespace App\Domain\Service;

use App\Domain\Enum\ChoixParieEnum;
use App\Repository\RencontreRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ParieService
{
    public function __construct(
        private RencontreRepository $rencontreRepository
    ){

    }
    public function calculGain(int $choix, float $mise,string $rencontreId){
         $rencontre = $this->rencontreRepository->find($rencontreId);

        if (!$rencontre) {
            throw new NotFoundHttpException("Rencontre avec l'ID $rencontreId non trouvée.");
        }

//         $cote = match ($choix) {
//            ChoixParieEnum::ZERO->value => $rencontre->getCoteEgalite(),
//            ChoixParieEnum::UN->value => $rencontre->getCoteVictoire1(),
//            ChoixParieEnum::DEUX->value => $rencontre->getCoteVictoire2(),
//             default => throw new \InvalidArgumentException("Choix invalide: doit être 1, 2, ou 0."),
//         };

         [$cote, $equipe] = match ($choix) {
            ChoixParieEnum::ZERO->value => [$rencontre->getCoteEgalite(), 'Égalité'],
            ChoixParieEnum::UN->value => [$rencontre->getCoteVictoire1(), $rencontre->getEquipe1()],
            ChoixParieEnum::DEUX->value => [$rencontre->getCoteVictoire2(), $rencontre->getEquipe2()],
             default => throw new \InvalidArgumentException("Choix invalide: doit être 1, 2, ou 0."),
        };

        // Calcul du gain
        $gainPotentiel = $mise * $cote;

        return [
            'gain' => $gainPotentiel,
            'equipe' => $equipe
        ];
    }

}