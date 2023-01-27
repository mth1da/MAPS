<?php

namespace App\Entity;

use App\Repository\SandwichRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SandwichRepository::class)]
class Sandwich
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $sandwich_name = null;

    #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'compose')]
    private ?Ingredient $ingredient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSandwichName(): ?string
    {
        return $this->sandwich_name;
    }

    public function setSandwichName(string $sandwich_name): self
    {
        $this->sandwich_name = $sandwich_name;

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }
}
