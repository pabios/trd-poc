<?php

namespace App\Tests\Service;
namespace App\Tests\Service;

use App\Domain\Enum\ChoixParieEnum;
use App\Domain\Service\ParieService;
use App\Repository\RencontreRepository;
use App\Entity\Rencontre;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// commande ==>  phpunit tests/Service/ParieTest.php --testdox
class ParieTest extends TestCase
{
    private ParieService $parieService;
    private $rencontreRepositoryMock;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->rencontreRepositoryMock = $this->createMock(RencontreRepository::class);

        $this->parieService = new ParieService($this->rencontreRepositoryMock);
    }

    public function testCalculGainVictoire1()
    {
        $rencontreMock = $this->createMock(Rencontre::class);
        $rencontreMock->method('getCoteVictoire1')->willReturn(1.5);
        $rencontreMock->method('getEquipe1')->willReturn('Barca');

        $this->rencontreRepositoryMock->method('find')->willReturn($rencontreMock);

        $gain = $this->parieService->calculGain(ChoixParieEnum::UN->value, 10, '1ef92cce-a1c7-6af6-b4ca-47f6df08833c');

        $this->assertEquals(15, $gain['gain']);
        $this->assertEquals('Barca', $gain['equipe']);
    }

    public function testCalculGainVictoire2()
    {
        $rencontreMock = $this->createMock(Rencontre::class);
        $rencontreMock->method('getCoteVictoire2')->willReturn(2.0);
        $rencontreMock->method('getEquipe2')->willReturn('PSG');

        $this->rencontreRepositoryMock->method('find')->willReturn($rencontreMock);

        $gain = $this->parieService->calculGain(ChoixParieEnum::DEUX->value, 20, '1ef92cce-a1c7-6af6-b4ca-47f6df08833c');

        $this->assertEquals(40, $gain['gain']);
        $this->assertEquals('PSG', $gain['equipe']);
    }

    public function testCalculGainEgalite()
    {
        $rencontreMock = $this->createMock(Rencontre::class);
        $rencontreMock->method('getCoteEgalite')->willReturn(1.8);

        $this->rencontreRepositoryMock->method('find')->willReturn($rencontreMock);

        $gain = $this->parieService->calculGain(ChoixParieEnum::ZERO->value, 15, '1ef92cce-a1c7-6af6-b4ca-47f6df08833c');

        $this->assertEquals(27, $gain['gain']);
        $this->assertEquals('Égalité', $gain['equipe']);
    }

    public function testRencontreNonTrouvee()
    {
        $this->rencontreRepositoryMock->method('find')->willReturn(null);

        $this->expectException(NotFoundHttpException::class);

        $this->parieService->calculGain(ChoixParieEnum::UN->value, 10, '1ef92cce-a1c7-6af6-b4ca-47f6df08833a');
    }

    public function testChoixInvalide()
    {
        $rencontreMock = $this->createMock(Rencontre::class);
        $this->rencontreRepositoryMock->method('find')->willReturn($rencontreMock);

        $this->expectException(\InvalidArgumentException::class);

        $this->parieService->calculGain(1, 10, '1ef92cce-a1c7-6af6-b4ca-47f6df08835c');
    }
}
