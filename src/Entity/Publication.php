<?php

namespace App\Entity;

use App\Repository\PublicationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublicationRepository::class)]
class Publication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $publi_likes = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $publi_comm = null;

    #[ORM\ManyToOne(inversedBy: 'publications')]
    private ?client $poste = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isPubliLikes(): ?bool
    {
        return $this->publi_likes;
    }

    public function setPubliLikes(?bool $publi_likes): self
    {
        $this->publi_likes = $publi_likes;

        return $this;
    }

    public function getPubliComm(): ?string
    {
        return $this->publi_comm;
    }

    public function setPubliComm(?string $publi_comm): self
    {
        $this->publi_comm = $publi_comm;

        return $this;
    }

    public function getPoste(): ?client
    {
        return $this->poste;
    }

    public function setPoste(?client $poste): self
    {
        $this->poste = $poste;

        return $this;
    }
}
