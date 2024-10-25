<?php

namespace App\Tests\Service;

use App\Domain\Enum\JeuxPierreEnum;
use App\Domain\Service\PierreFeuilleCiseauxService;
use PHPUnit\Framework\TestCase;

class PierreFeuilleCiseauxTest extends TestCase
{
    private PierreFeuilleCiseauxService $service;

    protected function setUp(): void
    {
        $this->service = new PierreFeuilleCiseauxService();
    }

    public function testSimulerPartieEgalite()
    {
         foreach ([JeuxPierreEnum::PIERRE, JeuxPierreEnum::FEUILLE, JeuxPierreEnum::CISEAUX] as $JeuxPierreEnum) {
            $resultat = $this->service->simulerPartieManuel($JeuxPierreEnum, $JeuxPierreEnum);
            $this->assertSame('Égalité', $resultat['résultat']);
        }
    }

    public function testSimulerPartieJoueur1Gagne()
    {
        $this->assertGagnant(JeuxPierreEnum::PIERRE, JeuxPierreEnum::CISEAUX, 'Joueur 1 gagne');
        $this->assertGagnant(JeuxPierreEnum::CISEAUX, JeuxPierreEnum::FEUILLE, 'Joueur 1 gagne');
        $this->assertGagnant(JeuxPierreEnum::FEUILLE, JeuxPierreEnum::PIERRE, 'Joueur 1 gagne');
    }

    public function testSimulerPartieJoueur2Gagne()
    {
        $this->assertGagnant(JeuxPierreEnum::CISEAUX, JeuxPierreEnum::PIERRE, 'Joueur 2 gagne');
        $this->assertGagnant(JeuxPierreEnum::FEUILLE, JeuxPierreEnum::CISEAUX, 'Joueur 2 gagne');
        $this->assertGagnant(JeuxPierreEnum::PIERRE, JeuxPierreEnum::FEUILLE, 'Joueur 2 gagne');
    }

    private function assertGagnant(JeuxPierreEnum $joueur1, JeuxPierreEnum $joueur2, string $expectedResult)
    {
        $resultat = $this->service->simulerPartieManuel($joueur1, $joueur2);
        $this->assertSame($expectedResult, $resultat['résultat']);
    }
}