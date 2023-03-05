<?php

namespace App\Controller\Api;

use App\Entity\Comment;
use App\Entity\Page;
use App\Form\CommentApiType;
use App\Repository\CommentRepository;
use App\Repository\PageRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ApiController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/comment/{id}")
     * @Rest\View(serializerGroups={"API_GET"})
     */
    public function comment(Comment $comment): View
    {
        return $this->view($comment, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/comment/")
     * @Rest\View(serializerGroups={"API_GET"})
     */
    public function comments(CommentRepository $commentRepository): View
    {
        $comments = $commentRepository->findAll();

        return $this->view($comments, Response::HTTP_OK);
    }

    /**
     * @Rest\Post("/comment/")
     * @Rest\View(serializerGroups={"API_GET"})
     */
    public function addComment(Request $request, CommentRepository $commentRepository): View
    {
        $data = json_decode($request->getContent(), true);
        $comment = new Comment();
        $form = $this->createForm(CommentApiType::class, $comment);
        $form->handleRequest($request);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentRepository->save($comment, true);

            return $this->view($comment, Response::HTTP_OK);
        }

        return $this->view($form, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Rest\Get("/page/{id}")
     * @Rest\View(serializerGroups={"API_GET"})
     */
    public function page(Page $page): View
    {
        return $this->view($page, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/page/")
     * @Rest\View(serializerGroups={"API_GET"})
     */
    public function pages(PageRepository $pageRepository): View
    {
        $pages = $pageRepository->findAll();

        return $this->view($pages, Response::HTTP_OK);
    }
}
