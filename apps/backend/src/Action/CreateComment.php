<?php

declare(strict_types=1);

namespace App\Action;

use App\Entity\Article;
use App\Entity\Comment;
use Doctrine\Persistence\ManagerRegistry;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

/** @Route("/article/{articleId}/comment", requirements={"articleId"="\d+"}, methods={"POST"}) */
final class CreateComment
{
    private ManagerRegistry $registry;
    private SerializerInterface $serializer;

    public function __construct(ManagerRegistry $registry, SerializerInterface $serializer)
    {
        $this->registry = $registry;
        $this->serializer = $serializer;
    }

    public function __invoke(Request $request, int $articleId): JsonResponse
    {
        $manager = $this->registry->getManager();
        $article = $manager->find(Article::class, $articleId);

        if ($article === null) {
            throw new InvalidArgumentException("Article not found");
        }

        assert($article instanceof Article);

        $comment = $this->serializer->deserialize(
            $request->getContent(),
            Comment::class,
            'json',
            [
                AbstractNormalizer::DEFAULT_CONSTRUCTOR_ARGUMENTS => [
                    Comment::class => [
                        'article' => $article
                    ]
                ]
            ]
        );

        $article->addComment($comment);

        $manager->persist($comment);
        $manager->flush();

        return new JsonResponse(
            $this->serializer->serialize(
                $comment,
                'json',
                [
                    ObjectNormalizer::ENABLE_MAX_DEPTH => true,
                    ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER => static function (object $object): int {
                        return $object->getId();
                    },
                ]
            ),
            200,
            [],
            true
        );
    }
}
