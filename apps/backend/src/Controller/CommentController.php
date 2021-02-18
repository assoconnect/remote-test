<?php

namespace App\Controller;

use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Flex\Response;

class CommentController extends AbstractController
{


    /**
     * Store a Comment
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Flex\Response
     * @Route("/article/{articleId}/comment", name="comment_store")
     */
    public function store(Request $request, ValidatorInterface $validator) : Response
    {
        $comment = new Comment();
        $comment->setAuthor($validator->validate($request->query->get('author')));
        $comment->setBody($validator->validate($request->query->get('body')));
        $comment->getAuthorPhone($validator->validate($request->query->get('author_phone')));
        $comment->setPublishedAt(date('H:i:s d/m/Y'));
        $comment->setCreatedAt(date('H:i:s d/m/Y'));
        $comment->SetUpdatedAt(date('H:i:s d/m/Y'));

        return new Response('Comment succesfully created', 200);
    }

}
