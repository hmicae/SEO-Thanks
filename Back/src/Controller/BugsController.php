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
class BugsController extends AbstractController
{
    #[Route('/', name: 'app_bugs_index', methods: ['GET'])]
    public function index(BugsRepository $bugsRepository): Response
    {
        return $this->render('bugs/index.html.twig', [
            'bugs' => $bugsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bugs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BugsRepository $bugsRepository): Response
    {
        $bug = new Bugs();
        $form = $this->createForm(BugsType::class, $bug);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bugsRepository->save($bug, true);

            return $this->redirectToRoute('app_bugs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bugs/new.html.twig', [
            'bug' => $bug,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bugs_show', methods: ['GET'])]
    public function show(Bugs $bug): Response
    {
        return $this->render('bugs/show.html.twig', [
            'bug' => $bug,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bugs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bugs $bug, BugsRepository $bugsRepository): Response
    {
        $form = $this->createForm(BugsType::class, $bug);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bugsRepository->save($bug, true);

            return $this->redirectToRoute('app_bugs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bugs/edit.html.twig', [
            'bug' => $bug,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bugs_delete', methods: ['POST'])]
    public function delete(Request $request, Bugs $bug, BugsRepository $bugsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bug->getId(), $request->request->get('_token'))) {
            $bugsRepository->remove($bug, true);
        }

        return $this->redirectToRoute('app_bugs_index', [], Response::HTTP_SEE_OTHER);
    }
}
