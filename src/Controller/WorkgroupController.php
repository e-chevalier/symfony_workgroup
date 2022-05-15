<?php

namespace App\Controller;

use App\Entity\Workgroup;
use App\Form\WorkgroupType;
use App\Repository\WorkgroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/workgroup')]
class WorkgroupController extends AbstractController
{
    #[Route('/', name: 'app_workgroup_index', methods: ['GET'])]
    public function index(WorkgroupRepository $workgroupRepository): Response
    {
        return $this->render('workgroup/index.html.twig', [
            'workgroups' => $workgroupRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_workgroup_new', methods: ['GET', 'POST'])]
    public function new(Request $request, WorkgroupRepository $workgroupRepository): Response
    {
        $workgroup = new Workgroup();
        $form = $this->createForm(WorkgroupType::class, $workgroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workgroupRepository->add($workgroup, true);

            return $this->redirectToRoute('app_workgroup_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('workgroup/new.html.twig', [
            'workgroup' => $workgroup,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_workgroup_show', methods: ['GET'])]
    public function show(Workgroup $workgroup): Response
    {
        return $this->render('workgroup/show.html.twig', [
            'workgroup' => $workgroup,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_workgroup_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Workgroup $workgroup, WorkgroupRepository $workgroupRepository): Response
    {
        $form = $this->createForm(WorkgroupType::class, $workgroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workgroupRepository->add($workgroup, true);

            return $this->redirectToRoute('app_workgroup_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('workgroup/edit.html.twig', [
            'workgroup' => $workgroup,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_workgroup_delete', methods: ['POST'])]
    public function delete(Request $request, Workgroup $workgroup, WorkgroupRepository $workgroupRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workgroup->getId(), $request->request->get('_token'))) {
            $workgroupRepository->remove($workgroup, true);
        }

        return $this->redirectToRoute('app_workgroup_index', [], Response::HTTP_SEE_OTHER);
    }
}
