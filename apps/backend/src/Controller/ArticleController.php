<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Flex\Response;

class ArticleController extends AbstractController
{

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * Show an Article
     *
     * @param int $id
     *
     * @return \Symfony\Component\Validator\Constraints\Json
     * @Route("/article/{articleId}", name="article_show")
     */
    public function show(int $id) : Json
    {
        $article = $this->getDoctrine()
                        ->getRepository(Article::class)
                        ->find($id);

        return $this->json([
            'title' => $article->getTitle(),
            'lastComment' => $article->getLastComment(),
            'path' => 'src/Controller/ArticleController.php',
        ]);
    }


    /**
     * Store an Article
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Flex\Response
     * @Route("/article/{articleId}", name="article_store")
     */
    public function store(Request $request) : Response
    {

        $article = new Article();
        $article->setTitle($request->query->get('title'));

        return new Response('Article succesfully created', 200);
    }

}
