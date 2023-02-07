<?php

namespace App\Entity;

use App\Repository\SandwichRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SandwichRepository::class)]
class OriginalSandwich extends Sandwich
{
    #[ORM\Column(type: Types::TEXT)]
    private string $description;

    public function setDescription(float $description): self
    {
        $this->description = $description;

        return $this;
    }
}