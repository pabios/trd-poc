<?php

namespace App\Domain\Service;

use App\Domain\Enum\JeuxPierreEnum;

class PierreFeuilleCiseauxService
{
    private array $options = [
        JeuxPierreEnum::PIERRE,
        JeuxPierreEnum::FEUILLE,
        JeuxPierreEnum::CISEAUX
    ];

    public function simulerPartie(): array
    {
        $joueur1Choix = $this->getChoixAleatoire();
        $joueur2Choix = $this->getChoixAleatoire();

        $resultat = $this->determinerGagnant($joueur1Choix, $joueur2Choix);

        return [
            'joueur1' => $joueur1Choix->value,
            'joueur2' => $joueur2Choix->value,
            'résultat' => $resultat,
        ];
    }

    private function getChoixAleatoire(): JeuxPierreEnum
    {
        return $this->options[array_rand($this->options)];
    }

    private function determinerGagnant(JeuxPierreEnum $joueur1Choix, JeuxPierreEnum $joueur2Choix): string
    {
        if ($joueur1Choix === $joueur2Choix) {
            return 'Égalité';
        }

        if (
            ($joueur1Choix === JeuxPierreEnum::PIERRE && $joueur2Choix === JeuxPierreEnum::CISEAUX) ||
            ($joueur1Choix === JeuxPierreEnum::CISEAUX && $joueur2Choix === JeuxPierreEnum::FEUILLE) ||
            ($joueur1Choix === JeuxPierreEnum::FEUILLE && $joueur2Choix === JeuxPierreEnum::PIERRE)
        ) {
            return 'Joueur 1 gagne';
        }

        return 'Joueur 2 gagne';
    }

    /**
     * @param JeuxPierreEnum $joueur1Choix
     * @param JeuxPierreEnum $joueur2Choix
     * @return array
     * Simulateur pour les Tests
     */
    public function simulerPartieManuel(JeuxPierreEnum $joueur1Choix, JeuxPierreEnum $joueur2Choix): array
    {
        $resultat = $this->determinerGagnant($joueur1Choix, $joueur2Choix);

        return [
            'joueur1' => $joueur1Choix->value,
            'joueur2' => $joueur2Choix->value,
            'résultat' => $resultat,
        ];
    }

}
