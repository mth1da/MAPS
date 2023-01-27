<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $resa_date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $resa_time = null;

    #[ORM\ManyToMany(targetEntity: table::class, inversedBy: 'reservations')]
    private Collection $refere;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?client $passee = null;

    public function __construct()
    {
        $this->refere = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResaDate(): ?\DateTimeInterface
    {
        return $this->resa_date;
    }

    public function setResaDate(\DateTimeInterface $resa_date): self
    {
        $this->resa_date = $resa_date;

        return $this;
    }

    public function getResaTime(): ?\DateTimeInterface
    {
        return $this->resa_time;
    }

    public function setResaTime(\DateTimeInterface $resa_time): self
    {
        $this->resa_time = $resa_time;

        return $this;
    }

    /**
     * @return Collection<int, table>
     */
    public function getRefere(): Collection
    {
        return $this->refere;
    }

    public function addRefere(table $refere): self
    {
        if (!$this->refere->contains($refere)) {
            $this->refere->add($refere);
        }

        return $this;
    }

    public function removeRefere(table $refere): self
    {
        $this->refere->removeElement($refere);

        return $this;
    }

    public function getPassee(): ?client
    {
        return $this->passee;
    }

    public function setPassee(?client $passee): self
    {
        $this->passee = $passee;

        return $this;
    }
}
