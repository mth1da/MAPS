<?php

namespace App\Entity;

use App\Repository\SandwichRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[Entity]
#[InheritanceType('JOINED')]
#[DiscriminatorColumn(name: 'discr', type: 'string')]
#[DiscriminatorMap(['sandwich' => Sandwich::class, 'sandwich_moment' => SandwichMoment::class, 'original_sandwich' => OriginalSandwich::class])] //heritage

#[ORM\Entity(repositoryClass: SandwichRepository::class)]
class Sandwich
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Ingredient::class)]
    private Collection $sandwich_ingredients;

    public function __construct()
    {
        $this->sandwich_ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getSandwichIngredients(): Collection
    {
        return $this->sandwich_ingredients;
    }

    public function addSandwichIngredient(Ingredient $sandwichIngredient): self
    {
        if (!$this->sandwich_ingredients->contains($sandwichIngredient)) {
            $this->sandwich_ingredients->add($sandwichIngredient);
        }

        return $this;
    }

    public function removeSandwichIngredient(Ingredient $sandwichIngredient): self
    {
        $this->sandwich_ingredients->removeElement($sandwichIngredient);

        return $this;
    }
}

class SandwichMoment extends Sandwich{
    #[ORM\Column(type: Types::TEXT)]
    private string $description;
}

class OriginalSandwich extends Sandwich{
    #[ORM\Column(type: Types::TEXT)]
    private string $description;
}