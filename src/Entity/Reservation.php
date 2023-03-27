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
    private \DateTimeInterface $dateTimeReservation;


    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Table $resa_table = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'], inversedBy: 'user_resa')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $resa_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTimeReservation(): ?\DateTimeInterface
    {
        return $this->dateTimeReservation;
    }

    public function setDateTimeReservation(\DateTimeInterface $dateTimeReservation): self
    {
        $this->dateTimeReservation = $dateTimeReservation;

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
