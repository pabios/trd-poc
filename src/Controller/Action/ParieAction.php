<?php

namespace App\Controller\Action;

use App\ApiResource\ParieModelDto;
use App\Domain\Service\ParieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ParieAction extends AbstractController
{
    public function __construct(
        private ParieService $parieService
    ){

    }

    public function __invoke(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {
        $parieDto = $serializer->deserialize($request->getContent(), ParieModelDto::class, 'json');

        // Valider les données du DTO
        $errors = $validator->validate($parieDto);
        if (count($errors) > 0) {
            $errorsArray = [];
            foreach ($errors as $error) {
                $errorsArray[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorsArray], JsonResponse::HTTP_BAD_REQUEST);
        }

         $gain = $this->parieService->calculGain($parieDto->choix,$parieDto->mise,$parieDto->rencontre);

        //dd($gain);

        return new JsonResponse([
            'choix' => $parieDto->choix,
            'mise' => $parieDto->mise,
            'rencontreId' => $parieDto->rencontre,
            'message' => 'Pari enregistré avec succès',
            'resultat'  => $gain
        ]);
    }
}