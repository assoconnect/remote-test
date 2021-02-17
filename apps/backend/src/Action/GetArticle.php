<?php

declare(strict_types=1);

namespace App\Action;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

/** @Route("/article/{articleId}", requirements={"articleId"="\d+"}, methods={"GET"}) */
final class GetArticle
{
    private ManagerRegistry $registry;
    private SerializerInterface $serializer;

    public function __construct(ManagerRegistry $registry, SerializerInterface $serializer)
    {
        $this->registry = $registry;
        $this->serializer = $serializer;
    }

    public function __invoke(int $articleId): JsonResponse
    {
        $manager = $this->registry->getManager();
        $article = $manager->find(Article::class, $articleId);

        if ($article === null) {
            throw new InvalidArgumentException("Article not found");
        }

        return new JsonResponse(
            $this->serializer->serialize(
                $article,
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
