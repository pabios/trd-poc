<?php

namespace App\Domain\Mapper\Cagnotte;

use App\ApiResource\CagnotteDto;
use App\ApiResource\UserDto;
use App\Entity\Cagnotte;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;
use Symfonycasts\MicroMapper\MicroMapperInterface;


#[AsMapper(from: Cagnotte::class,to: CagnotteDto::class)]
class CagnotteEntityToDtoMapper implements MapperInterface
{
    public function __construct(
        private MicroMapperInterface $microMapper
    )
    {
    }

    public function load(object $from, string $toClass, array $context): object
    {
        $entity = $from;
        assert($entity instanceof Cagnotte);

        $dto = new CagnotteDto();
        $dto->id = $entity->getId();

        return $dto;
    }

    public function populate(object $from, object $to, array $context): object
    {
        $entity = $from;
        $dto = $to;
        assert($entity instanceof  Cagnotte);
        assert($dto instanceof CagnotteDto);

        $dto->solde = $entity->getSolde();

        if ($entity->getUser()){
            $dto->user = $this->microMapper->map($entity->getUser(),UserDto::class);
        }

        return $dto;
    }
}