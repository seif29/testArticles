<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Page;
use App\Form\CommentType;
use App\Form\PageType;
use App\Repository\CommentRepository;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/page')]
class PageController extends AbstractController
{
    #[Route('/', name: 'app_page_index', methods: ['GET'])]
    public function index(PageRepository $pageRepository): Response
    {
        return $this->render('page/index.html.twig', [
            'pages' => $pageRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_page_show', methods: ['GET'])]
    public function show(Page $page): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        return $this->render('page/show.html.twig', [
            'page' => $page,
            'form' => $form
        ]);
    }

    #[Route('/{page}/{comment?null}/add_comment/', name: 'app_page_new_comment', methods: ['POST'])]
    public function new(Page $page, ?Comment $comment, Request $request, CommentRepository $commentRepository): Response
    {
        $newComment = new Comment();
        $form = $this->createForm(CommentType::class, $newComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newComment->setUser($this->getUser());
            $comment ? $newComment->setParent($comment) : $newComment->setPage($page);

            $commentRepository->save($newComment, true);

            return $this->redirectToRoute('app_page_show', ['id' => $page->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('page/new.html.twig', [
            'page' => $page,
            'form' => $form,
        ]);
    }
}
