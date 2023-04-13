<?php

namespace App\Controller;

use App\Entity\Insects;
use App\Form\InsectsType;
use App\Repository\InsectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/insects')]
class InsectsController extends AbstractController
{
    #[Route('/list', name: 'app_apiinsects_index', methods: ['GET'])]
    public function index(InsectsRepository $insectsRepository): Response
    {
        $insects = $insectsRepository->findAll();
        $data = [];

        foreach ($insects as $p) {
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
