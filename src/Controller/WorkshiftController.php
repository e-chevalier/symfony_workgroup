<?php

namespace App\Controller;

use App\Entity\Workshift;
use App\Form\WorkshiftType;
use App\Repository\WorkshiftRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/workshift')]
class WorkshiftController extends AbstractController
{
    #[Route('/', name: 'app_workshift_index', methods: ['GET'])]
    public function index(WorkshiftRepository $workshiftRepository): Response
    {
        return $this->render('workshift/index.html.twig', [
            'workshifts' => $workshiftRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_workshift_new', methods: ['GET', 'POST'])]
    public function new(Request $request, WorkshiftRepository $workshiftRepository): Response
    {
        $workshift = new Workshift();
        $form = $this->createForm(WorkshiftType::class, $workshift);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workshiftRepository->add($workshift, true);

            return $this->redirectToRoute('app_workshift_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('workshift/new.html.twig', [
            'workshift' => $workshift,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_workshift_show', methods: ['GET'])]
    public function show(Workshift $workshift): Response
    {
        return $this->render('workshift/show.html.twig', [
            'workshift' => $workshift,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_workshift_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Workshift $workshift, WorkshiftRepository $workshiftRepository): Response
    {
        $form = $this->createForm(WorkshiftType::class, $workshift);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workshiftRepository->add($workshift, true);

            return $this->redirectToRoute('app_workshift_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('workshift/edit.html.twig', [
            'workshift' => $workshift,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_workshift_delete', methods: ['POST'])]
    public function delete(Request $request, Workshift $workshift, WorkshiftRepository $workshiftRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workshift->getId(), $request->request->get('_token'))) {
            $workshiftRepository->remove($workshift, true);
        }

        return $this->redirectToRoute('app_workshift_index', [], Response::HTTP_SEE_OTHER);
    }
}
