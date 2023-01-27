<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $commande_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommandeDate(): ?\DateTimeInterface
    {
        return $this->commande_date;
    }

    public function setCommandeDate(\DateTimeInterface $commande_date): self
    {
        $this->commande_date = $commande_date;

        return $this;
    }
}
