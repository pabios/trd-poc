<?php

namespace App\Domain\Mapper\Rencontre;

use App\ApiResource\RencontreDto;
use App\Entity\Rencontre;
use App\Repository\RencontreRepository;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;


#[AsMapper(from: RencontreDto::class,to: Rencontre::class)]
class RencontreDtoToEntityMapper implements MapperInterface
{

    public function __construct(
        private RencontreRepository $rencontreRepository,
    )
    {
    }

    public function load(object $from, string $toClass, array $context): object
    {
        $dto = $from;
        assert($dto instanceof RencontreDto);

        return $dto->id ? $this->rencontreRepository->find($dto->id) : new Rencontre();
    }

    public function populate(object $from, object $to, array $context): object
    {
        $dto = $from;
        $entity = $to;
        assert($dto instanceof RencontreDto);
        assert($entity instanceof Rencontre);

        $entity->setEquipe1($dto->equipe1);
        $entity->setEquipe2($dto->equipe2);

        $entity->setCoteEgalite($dto->coteEgalite);
        $entity->setCoteVictoire1($dto->coteVictoire1);
        $entity->setCoteVictoire2($dto->coteVictoire2);

        return $entity;
    }
}