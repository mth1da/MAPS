<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private \DateTimeInterface $date;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private \DateTimeInterface $time;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Table $resa_table = null;

    #[ORM\ManyToOne(inversedBy: 'user_resa')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $resa_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getResaTable(): ?Table
    {
        return $this->resa_table;
    }

    public function setResaTable(?Table $resa_table): self
    {
        $this->resa_table = $resa_table;

        return $this;
    }

    public function getResaUser(): ?User
    {
        return $this->resa_user;
    }

    public function setResaUser(?User $resa_user): self
    {
        $this->resa_user = $resa_user;

        return $this;
    }
    public function __toString(){
        return  $this->id;
    }
}
