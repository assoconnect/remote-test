<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @Groups("comment")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", cascade={"persist"}, inversedBy="comments")
     */
    private $article;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("comment")
     */
    private $publicationDate;

    /**
     * @ORM\Column(type="text")
     * @Groups("comment")
     */
    private $body;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("comment")
     */
    private $authorPseudo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("comment")
     */
    private $authorPhone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getPublicationDate(): ?\DateTime
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTime $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getAuthorPseudo(): ?string
    {
        return $this->authorPseudo;
    }

    public function setAuthorPseudo(string $authorPseudo): self
    {
        $this->authorPseudo = $authorPseudo;

        return $this;
    }

    public function getAuthorPhone(): ?string
    {
        return $this->authorPhone;
    }

    public function setAuthorPhone(?string $authorPhone): self
    {
        $this->authorPhone = $authorPhone;

        return $this;
    }
}
