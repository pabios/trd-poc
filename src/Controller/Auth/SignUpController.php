<?php

namespace App\Controller\Auth;

use App\ApiResource\UserDto;
use App\Domain\Mapper\User\UserDtoToEntityMapper;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\JsonException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SignUpController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager, private UserDtoToEntityMapper $userDtoToEntityMapper)
    {
    }
    #[Route('/sign_up', name: 'sign_up', methods: ['POST'])]
    public function signUp(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new JsonException('Invalid JSON format');
            }

            if (!isset($data['email']) || !isset($data['password'])) {
                return new JsonResponse(['message' => 'Email and password are required'], 400);
            }

            $userDto = new UserDto();
            $userDto->email = $data['email'];
            $userDto->password = $data['password'];

            $user = $this->userDtoToEntityMapper->map($userDto, User::class);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return new JsonResponse(['message' => 'User successfully created'], 201);

        } catch (JsonException $e) {
            return new JsonResponse(['message' => 'Invalid JSON format: ' . $e->getMessage()], 400);

        } catch (ORMException $e) {
            return new JsonResponse(['message' => 'Database error: ' . $e->getMessage()], 500);

        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


}