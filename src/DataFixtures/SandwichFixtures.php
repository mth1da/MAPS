<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Sandwich;
use doctrine\common\datafixtures\DependentFixtureInterface;
class SandwichFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $MAPS = new Sandwich();
        $MAPS->setName('Le MAPS');
        $MAPS->setIsOriginal(True);
        $MAPS->setPrice(150);
        $MAPS->setPhoto("mapsSandwich2.jpg");
        $MAPS->addSandwichIngredient($this->getReference("burger"));
        $MAPS->addSandwichIngredient($this->getReference("cheddar"));
        $MAPS->addSandwichIngredient($this->getReference("tomate"));
        $manager->persist($MAPS);

        $royal = new Sandwich();
        $royal->setName('Le Royal');
        $royal->setPrice(500);
        $royal->setIsOriginal(True);
        $royal->setPhoto("royal.jpg");
        $royal->addSandwichIngredient($this->getReference("mie"));
        $royal->addSandwichIngredient($this->getReference("crevette"));
        $royal->addSandwichIngredient($this->getReference("concombre"));
        $royal->addSandwichIngredient($this->getReference("oignon"));
        $royal->addSandwichIngredient($this->getReference("mozza"));
        $royal->addSandwichIngredient($this->getReference("oeuf"));
        $royal->addSandwichIngredient($this->getReference("tomate"));
        $royal->addSandwichIngredient($this->getReference("curry"));
        $royal->addSandwichIngredient($this->getReference("olive"));
        $manager->persist($royal);

        $JB = new Sandwich();
        $JB->setName('Le Jambon-Beurre');
        $JB->setPrice(200);
        $JB->setIsOriginal(True);
        $JB->setPhoto("jambonBeurreSandwich.jpg");
        $JB->addSandwichIngredient($this->getReference("baguette"));
        $JB->addSandwichIngredient($this->getReference("jambon"));
        $JB->addSandwichIngredient($this->getReference("beurre"));
        $manager->persist($JB);

        $manager->flush();
    }

    public function getDependencies():array
    {
        return[IngredientFixtures::class];
    }
}