<?php

namespace App\Controller;

use App\Entity\Plants;
use App\Form\PlantsType;
use App\Repository\PlantsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/plants')]
class PlantsController extends AbstractController
{
    #[Route('/list', name: 'app_apiplants_index', methods: ['GET'])]
    public function index(PlantsRepository $plantsRepository): Response
    {
        $plants = $plantsRepository->findAll();
        $data = [];

        foreach ($plants as $p) {
            $data[] = [
                'id' => $p->getId(),
                'name' => $p->getName(),
                'description' => $p->getDescription(),
            ];
        }
        
        // return $this->json($data);
        return $this->json($data, $status = 200, $headers = ['Access-Control-Allow-Origin'=>'*']);
    }

}