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
    #[Route('/', name: 'app_plants_index', methods: ['GET'])]
    public function index(PlantsRepository $plantsRepository): Response
    {
        return $this->render('plants/index.html.twig', [
            'plants' => $plantsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_plants_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PlantsRepository $plantsRepository): Response
    {
        $plant = new Plants();
        $form = $this->createForm(PlantsType::class, $plant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plantsRepository->save($plant, true);

            return $this->redirectToRoute('app_plants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plants/new.html.twig', [
            'plant' => $plant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plants_show', methods: ['GET'])]
    public function show(Plants $plant): Response
    {
        return $this->render('plants/show.html.twig', [
            'plant' => $plant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plants_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Plants $plant, PlantsRepository $plantsRepository): Response
    {
        $form = $this->createForm(PlantsType::class, $plant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plantsRepository->save($plant, true);

            return $this->redirectToRoute('app_plants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plants/edit.html.twig', [
            'plant' => $plant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plants_delete', methods: ['POST'])]
    public function delete(Request $request, Plants $plant, PlantsRepository $plantsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plant->getId(), $request->request->get('_token'))) {
            $plantsRepository->remove($plant, true);
        }

        return $this->redirectToRoute('app_plants_index', [], Response::HTTP_SEE_OTHER);
    }
}
