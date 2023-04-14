<?php

namespace App\Controller;

use App\Entity\Plant;
use App\Form\PlantsType;
use App\Repository\PlantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/plant')]
class ApiPlantController extends AbstractController
{
    #[Route('/list', name: 'app_apiplant_index', methods: ['GET'])]
    public function index(PlantRepository $plantRepository): Response
    {
        $plant = $plantRepository->findAll();
        $data = [];

        foreach ($plant as $p) {
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