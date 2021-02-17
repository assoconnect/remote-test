<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity() */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /** @ORM\Column(type="string", length=255) */
    private ?string $title;

    /** @ORM\Column(type="text") */
    private ?string $content;

    /** @ORM\OneToMany(targetEntity=Comment::class, mappedBy="article", cascade={"remove"}, orphanRemoval=true) */
    private Collection $comments;

    /**
     * @ORM\OneToOne(targetEntity=Comment::class)
     * @ORM\JoinColumn(name="last_comment_id", referencedColumnName="id", onDelete="cascade")
     */
    private ?Comment $lastComment;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    /** @return Collection<Comment> */
    public function addComment(Comment $comment): void
    {
        $this->comments->add($comment);
        $this->lastComment = $comment;
    }

    public function getLastComment(): ?Comment
    {
        return $this->lastComment;
    }
}
