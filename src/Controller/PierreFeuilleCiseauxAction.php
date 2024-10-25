<?php

namespace App\Controller;

use App\Domain\Service\PierreFeuilleCiseauxService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PierreFeuilleCiseauxAction extends  AbstractController
{

    public function __construct(
        private PierreFeuilleCiseauxService $pierreFeuilleCiseauxService
    ){}
    public function __invoke(){
        $rep = $this->pierreFeuilleCiseauxService->simulerPartie();

        return $this->json(['reponse'=>$rep]);
    }
}