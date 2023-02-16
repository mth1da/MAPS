<?php

namespace App\Entity;

use App\Repository\BookmarkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookmarkRepository::class)]
class Bookmark
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'user_bookmarks')]
    #[ORM\JoinColumn(nullable: true)]
    private ?user $bookmark_user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sandwich $bookmark_sandwich = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookmarkUser(): ?User
    {
        return $this->bookmark_user;
    }

    public function setBookmarkUser(?User $bookmark_user): self
    {
        $this->bookmark_user = $bookmark_user;

        return $this;
    }

    public function getBookmarkSandwich(): ?Sandwich
    {
        return $this->bookmark_sandwich;
    }

    public function setBookmarkSandwich(?Sandwich $bookmark_sandwich): self
    {
        $this->bookmark_sandwich = $bookmark_sandwich;

        return $this;
    }
}
