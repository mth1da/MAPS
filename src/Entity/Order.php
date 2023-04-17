<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`Order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private string $cost;

    #[ORM\Column(nullable: true)]
    private ?int $discount = null;

    #[ORM\Column]
    private \DateTimeImmutable $created_at;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")] //si on supp un user => toutes ses orders sup
    private ?User $order_user = null;

    function __construct(){ //constructeur
        $this->created_at = new \DateTimeImmutable(); //date du jour automatiquement
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(string $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(?int $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getOrderUser(): ?User
    {
        return $this->order_user;
    }

    public function setOrderUser(?User $order_user): self
    {
        $this->order_user = $order_user;

        return $this;
    }
/*
    public function __toString(){
        return  $this->id;
    }*/
}
