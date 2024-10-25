<?php

namespace App\Domain\Mapper\User;

use App\ApiResource\UserDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: UserDto::class,to: User::class)]
class UserDtoToEntityMapper implements MapperInterface
{

    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $userPasswordHasher,
    )
    {
    }

    public function load(object $from, string $toClass, array $context): object
    {
        $dto = $from;
        assert($dto instanceof UserDto);

        $userEntity = $dto->id ? $this->userRepository->find($dto->id) : new User();
        if (!$userEntity) {
            throw new \Exception('User not found');
        }

        return $userEntity;
    }

    public function populate(object $from, object $to, array $context): object
    {
        $dto = $from;
        assert($dto instanceof UserDto);
        $entity = $to;
        assert($entity instanceof User);

        if ($dto->password) {
            $entity->setPassword($this->userPasswordHasher->hashPassword($entity, $dto->password));
        }

        return $entity;
    }

    public function map(UserDto $userDto, string $entityClass): User
    {
        $user = new $entityClass();
        $user->setEmail($userDto->email);
        $user->setPassword(
            $this->userPasswordHasher->hashPassword($user, $userDto->password)
        );
        return $user;
    }
}

