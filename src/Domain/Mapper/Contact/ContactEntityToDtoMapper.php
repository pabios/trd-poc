<?php

namespace App\Domain\Mapper\Contact;

use App\ApiResource\CagnotteDto;
use App\ApiResource\ContactDto;
use App\ApiResource\UserDto;
use App\Entity\Cagnotte;
use App\Entity\Contact;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;
use Symfonycasts\MicroMapper\MicroMapperInterface;


#[AsMapper(from: Contact::class,to: ContactDto::class)]
class ContactEntityToDtoMapper implements MapperInterface
{
    public function __construct(
        private MicroMapperInterface $microMapper
    )
    {
    }

    public function load(object $from, string $toClass, array $context): object
    {
        $entity = $from;
        assert($entity instanceof Contact);

        $dto = new ContactDto();
        $dto->id = $entity->getId();

        return $dto;
    }

    public function populate(object $from, object $to, array $context): object
    {
        $entity = $from;
        $dto = $to;
        assert($entity instanceof  Contact);
        assert($dto instanceof ContactDto);

        $dto->name = $entity->getName();
        $dto->email = $entity->getEmail();
        $dto->phone = $entity->getPhone();

        return $dto;
    }
}