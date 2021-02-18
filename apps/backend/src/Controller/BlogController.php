<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentType;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BlogController.php',
        ]);
    }

    /**
     * @Route("/article/{id}", name="article")
     */
    public function article(Article $article, SerializerInterface $serializer)
    {
        $serializedComment = $serializer->normalize($article->getLastComment(), null, ['groups' => 'comment']);

        $serializedArticle = $serializer->normalize($article, null, ['groups' => 'article']);
        $serializedArticle['lastComment'] = $serializedComment;

        return $this->json($serializedArticle);
    }

    /**
     * @Route("/article/{id}/comment", name="new_comment")
     */
    public function newComment(Article $article, Request $request, EntityManagerInterface $em)
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setPublicationDate(new \DateTime());
            $comment->setArticle($article);

            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Your comment was successfully added.');
            return $this->redirectToRoute('article', ['id' => $article->getId()]);
        }

        return $this->render('blog/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
