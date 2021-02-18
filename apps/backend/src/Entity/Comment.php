<?php

namespace App\Entity;

use Doctrine\DBAL\Types\DateType;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\Column(type="string", length=22)
     */
    private $authorPhone;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $deletedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article")
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }


    public function getBody(): ?string
    {
        return $this->body;
    }


    public function getAuthorPhone(): ?string
    {
        return $this->authorPhone;
    }

    public function getPublishedAt(): ?string
    {
        return $this->publishedAt;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }


    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setAuthor(string $author): self
    {
        $this->content = $author;

        return $this;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function setAuthorPhone(string $authorPhone): self
    {
        $this->authorPhone = $authorPhone;

        return $this;
    }

    public function setPublishedAt(DateType $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function setCreatedAt(DateType $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function SetUpdatedAt(DateType $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function setDeletedAt(DateType $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}
