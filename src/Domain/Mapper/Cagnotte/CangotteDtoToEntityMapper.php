<?php

namespace App\Domain\Mapper\Cagnotte;

use App\ApiResource\CagnotteDto;
use App\ApiResource\ElementDto;
use App\Entity\Cagnotte;
use App\Entity\Element;
use App\Entity\User;
use App\Repository\CagnotteRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;
use Symfonycasts\MicroMapper\MicroMapperInterface;

#[AsMapper(from: CagnotteDto::class,to: Cagnotte::class)]
class CangotteDtoToEntityMapper implements MapperInterface
{

    public function __construct(
        private CagnotteRepository $cagnotteRepository,
        private MicroMapperInterface $microMapper,
        private Security $security
    )
    {
    }

    public function load(object $from, string $toClass, array $context): object
    {
        $dto = $from;
        assert($dto instanceof CagnotteDto);

        return $dto->id ? $this->cagnotteRepository->find($dto->id) : new Cagnotte();
    }

    public function populate(object $from, object $to, array $context): object
    {
        $dto = $from;
        $entity = $to;
        assert($dto instanceof CagnotteDto);
        assert($entity instanceof Cagnotte);

        $entity->setSolde($dto->solde);

        if ($dto->user){
            $user = $this->microMapper->map($dto->user,User::class);
            $entity->setUser($user);
        }else{
            $entity->setUser($this->security->getUser());
        }

        return $entity;
    }
}