<?php

namespace App\Domain\Mapper\Rencontre;

use App\ApiResource\RencontreDto;
use App\Entity\Rencontre;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;
use Symfonycasts\MicroMapper\MicroMapperInterface;


#[AsMapper(from: Rencontre::class,to: RencontreDto::class)]
class RencontreEntityToDtoMapper implements MapperInterface
{
    public function __construct(
        private MicroMapperInterface $microMapper
    )
    {
    }

    public function load(object $from, string $toClass, array $context): object
    {
        $entity = $from;
        assert($entity instanceof Rencontre);

        $dto = new RencontreDto();
        $dto->id = $entity->getId();

        return $dto;
    }

    public function populate(object $from, object $to, array $context): object
    {
        $entity = $from;
        $dto = $to;
        assert($entity instanceof  Rencontre);
        assert($dto instanceof RencontreDto);

        $dto->coteVictoire1 = $entity->getCoteVictoire1();
        $dto->coteVictoire2 = $entity->getCoteVictoire2();
        $dto->coteEgalite = $entity->getCoteEgalite();
        $dto->equipe1 = $entity->getEquipe1();
        $dto->equipe2 = $entity->getEquipe2();
        $dto->dateDuMatch = $entity->getDateMatch();


        return $dto;
    }
}