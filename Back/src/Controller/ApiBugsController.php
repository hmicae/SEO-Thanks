<?php

namespace App\Controller;

use App\Entity\Bugs;
use App\Form\BugsType;
use App\Repository\BugsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bugs')]
class ApiBugsController extends AbstractController
{
    #[Route('/list', name: 'app_apibugs_index', methods: ['GET'])]
    public function index(BugsRepository $bugsRepository): Response
    {
        $bugs = $bugsRepository->findAll();
        $data = [];

        foreach ($bugs as $p) {
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