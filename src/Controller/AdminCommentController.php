<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\AdminCommentType;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Service\PaginationService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCommentController extends AbstractController
{
    /**
     * @Route("/admin/comments/{page<\d+>?1}", name="admin_comments_index")
     */
    public function index(CommentRepository $repo, $page, PaginationService $pagination): Response
    {
        $pagination->setEntityClass(Comment::class)
            ->setPage($page);

        return $this->render('admin/comment/index.html.twig', [
            'pagination' => $pagination
            ]);
    }

    /**
     * @Route ("/admin/comments/{id}/edit", name="admin_comments_edit")
     *
     *
     * @param Comment $comment
     * @param Request $request
     * @param ManagerRegistry $manager
     * @return Response
     */
    public function edit(Comment $comment, Request $request, ManagerRegistry $manager){
        $form = $this->createForm(AdminCommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $manager->getManager();
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'Success',
                "Les modifications sont ok !");
        }

        return $this->render('admin/comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/comments/{id}/delete", name="admin_comments_delete")
     *
     * @param Comment $comment
     * @param ManagerRegistry $manager
     * @return Response
     *
     */
    public function delete(Comment $comment, ManagerRegistry $manager){
        $manager = $manager->getManager();
        $manager->remove($comment);
        $manager->flush();

        $this->addFlash(
            'success',
            "le comment a bien été supprimé"
        );
            return $this->redirectToRoute('admin_comments_index');

    }
}


