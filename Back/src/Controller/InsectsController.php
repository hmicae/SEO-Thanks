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
    #[Route('/', name: 'app_insects_index', methods: ['GET'])]
    public function index(InsectsRepository $insectsRepository): Response
    {
        return $this->render('insects/index.html.twig', [
            'insects' => $insectsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_insects_new', methods: ['GET', 'POST'])]
    public function new(Request $request, InsectsRepository $insectsRepository): Response
    {
        $insect = new Insects();
        $form = $this->createForm(InsectsType::class, $insect);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $insectsRepository->save($insect, true);

            return $this->redirectToRoute('app_insects_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('insects/new.html.twig', [
            'insect' => $insect,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_insects_show', methods: ['GET'])]
    public function show(Insects $insect): Response
    {
        return $this->render('insects/show.html.twig', [
            'insect' => $insect,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_insects_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Insects $insect, InsectsRepository $insectsRepository): Response
    {
        $form = $this->createForm(InsectsType::class, $insect);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $insectsRepository->save($insect, true);

            return $this->redirectToRoute('app_insects_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('insects/edit.html.twig', [
            'insect' => $insect,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_insects_delete', methods: ['POST'])]
    public function delete(Request $request, Insects $insect, InsectsRepository $insectsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$insect->getId(), $request->request->get('_token'))) {
            $insectsRepository->remove($insect, true);
        }

        return $this->redirectToRoute('app_insects_index', [], Response::HTTP_SEE_OTHER);
    }
}
