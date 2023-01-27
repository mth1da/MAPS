<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $ingredient_name = null;

    #[ORM\Column]
    private ?float $ingredient_price = null;

    #[ORM\Column]
    private ?int $ingredient_quantity = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $ingredient_photo = null;

    #[ORM\ManyToMany(targetEntity: sandwich::class, mappedBy: 'ingredient')]
    private Collection $compose;

    public function __construct()
    {
        $this->compose = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIngredientName(): ?string
    {
        return $this->ingredient_name;
    }

    public function setIngredientName(string $ingredient_name): self
    {
        $this->ingredient_name = $ingredient_name;

        return $this;
    }

    public function getIngredientPrice(): ?float
    {
        return $this->ingredient_price;
    }

    public function setIngredientPrice(float $ingredient_price): self
    {
        $this->ingredient_price = $ingredient_price;

        return $this;
    }

    public function getIngredientQuantity(): ?int
    {
        return $this->ingredient_quantity;
    }

    public function setIngredientQuantity(int $ingredient_quantity): self
    {
        $this->ingredient_quantity = $ingredient_quantity;

        return $this;
    }

    public function getIngredientPhoto(): ?string
    {
        return $this->ingredient_photo;
    }

    public function setIngredientPhoto(?string $ingredient_photo): self
    {
        $this->ingredient_photo = $ingredient_photo;

        return $this;
    }

    /**
     * @return Collection<int, sandwich>
     */
    public function getCompose(): Collection
    {
        return $this->compose;
    }

    public function addCompose(sandwich $compose): self
    {
        if (!$this->compose->contains($compose)) {
            $this->compose->add($compose);
            $compose->setIngredient($this);
        }

        return $this;
    }

    public function removeCompose(sandwich $compose): self
    {
        if ($this->compose->removeElement($compose)) {
            // set the owning side to null (unless already changed)
            if ($compose->getIngredient() === $this) {
                $compose->setIngredient(null);
            }
        }

        return $this;
    }
}
