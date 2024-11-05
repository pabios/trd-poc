<?php

namespace App\Domain\Mapper\Contact;

use App\ApiResource\ContactDto;
use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: ContactDto::class,to: Contact::class)]
class ContactDtoToEntityMapper implements MapperInterface
{

    public function __construct(
        private ContactRepository $contactRepository,
        private Security $security
    )
    {
    }

    public function load(object $from, string $toClass, array $context): object
    {
        $dto = $from;
        assert($dto instanceof ContactDto);

        return $dto->id ? $this->contactRepository->find($dto->id) : new Contact();
    }

    public function populate(object $from, object $to, array $context): object
    {
        $dto = $from;
        $entity = $to;
        assert($dto instanceof ContactDto);
        assert($entity instanceof Contact);

        $entity->setName($dto->name);
        $entity->setEmail($dto->email);
        $entity->setPhone($dto->phone);

        return $entity;
    }
}
