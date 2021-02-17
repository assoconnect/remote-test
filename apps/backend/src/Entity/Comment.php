<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /** @ORM\Column(type="text", nullable=false) */
    private string $body;

    /** @ORM\Column(type="string", nullable=false) */
    private string $author;

    /** @ORM\Column(type="string", nullable=false, name="author_phone_number") */
    private string $authorPhoneNumber;

    /** @ORM\Column(type="datetime_immutable", name="published_at") */
    private DateTimeInterface $publishedAt;

    /** @ORM\ManyToOne(targetEntity=Article::class, inversedBy="comments") */
    private Article $article;

    public function __construct(Article $article, string $body, string $author, string $authorPhoneNumber)
    {
        $this->body = $body;
        $this->author = $author;
        $this->article = $article;
        $this->authorPhoneNumber = $authorPhoneNumber;

        $this->publishedAt = new DateTimeImmutable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getAuthorPhoneNumber(): string
    {
        return $this->authorPhoneNumber;
    }

    public function getPublishedAt(): DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }
}
