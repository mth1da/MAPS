<?php

namespace App\Tests;

use App\Entity\Ingredient;
use App\Entity\Type;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class IngredientUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $ingredient = new Ingredient();
        $type = new Type();
        $createdAt = new DateTimeImmutable();
        $updatedAt = new DateTimeImmutable();
        $deletedAt = new DateTimeImmutable();

        $ingredient->setName('homar');
        $ingredient->setDescription('Du bon homard tout frais.');
        $ingredient->setPrice('300');
        $ingredient->setPhoto('homar.jpg');
        $ingredient->setTypes($type);
        $ingredient->setCreatedAt($createdAt);
        $ingredient->setUpdatedAt($updatedAt);
        $ingredient->setDeletedAt($deletedAt);

        $this->assertTrue($ingredient->getName() === 'homar');
        $this->assertTrue($ingredient->getDescription() === 'Du bon homard tout frais.');
        $this->assertTrue($ingredient->getPrice() === '300');
        $this->assertTrue($ingredient->getPhoto() === 'homar.jpg');
        $this->assertTrue($ingredient->getTypes() === $type);
        $this->assertTrue($ingredient->getCreatedAt() === $createdAt);
        $this->assertTrue($ingredient->getUpdatedAt() === $updatedAt);
        $this->assertTrue($ingredient->getDeletedAt() === $deletedAt);

    }

    public function testIsFalse()
    {
        $ingredient = new Ingredient();
        $type = new Type();
        $createdAt = new DateTimeImmutable();
        $updatedAt = new DateTimeImmutable();
        $deletedAt = new DateTimeImmutable();

        $ingredient->setName('homar');
        $ingredient->setDescription('Du bon homard tout frais.');
        $ingredient->setPrice('300');
        $ingredient->setPhoto('homar.jpg');
        $ingredient->setTypes($type);
        $ingredient->setCreatedAt($createdAt);
        $ingredient->setUpdatedAt($updatedAt);
        $ingredient->setDeletedAt($deletedAt);

        $this->assertFalse($ingredient->getName() === 'crabe');
        $this->assertFalse($ingredient->getDescription() === 'Du bon crabe tout chaud.');
        $this->assertFalse($ingredient->getPrice() === '350');
        $this->assertFalse($ingredient->getPhoto() === 'crabe.jpg');
        $this->assertFalse($ingredient->getCreatedAt() === $deletedAt);
        $this->assertFalse($ingredient->getUpdatedAt() === $createdAt);
        $this->assertFalse($ingredient->getDeletedAt() === $updatedAt);

    }
}
