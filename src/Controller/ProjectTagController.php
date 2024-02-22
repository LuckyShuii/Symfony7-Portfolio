<?php

namespace App\Controller;

use App\Entity\ProjectTag;
use App\Form\ProjectTagType;
use App\Repository\ProjectTagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/project/tag')]
class ProjectTagController extends AbstractController
{
    #[Route('/', name: 'app_project_tag_index', methods: ['GET'])]
    public function index(ProjectTagRepository $projectTagRepository): Response
    {
        return $this->render('project_tag/index.html.twig', [
            'project_tags' => $projectTagRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_project_tag_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $projectTag = new ProjectTag();
        $form = $this->createForm(ProjectTagType::class, $projectTag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($projectTag);
            $entityManager->flush();

            return $this->redirectToRoute('app_project_tag_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('project_tag/new.html.twig', [
            'project_tag' => $projectTag,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_project_tag_show', methods: ['GET'])]
    public function show(ProjectTag $projectTag): Response
    {
        return $this->render('project_tag/show.html.twig', [
            'project_tag' => $projectTag,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_project_tag_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProjectTag $projectTag, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProjectTagType::class, $projectTag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_project_tag_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('project_tag/edit.html.twig', [
            'project_tag' => $projectTag,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_project_tag_delete', methods: ['POST'])]
    public function delete(Request $request, ProjectTag $projectTag, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projectTag->getId(), $request->request->get('_token'))) {
            $entityManager->remove($projectTag);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_project_tag_index', [], Response::HTTP_SEE_OTHER);
    }
}
