<?php

namespace App\DataFixtures;

use App\Entity\OriginalSandwich;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
class SandwichOriginalFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $MAPS = new OriginalSandwich();
        $MAPS->setName('MAPS');
        //$MAPS->addSandwichIngredient(Ingredient $ciabatta);
        //$MAPS->addSandwichIngredient(Ingredient $chorizo);
        //$MAPS->addSandwichIngredient(Ingredient $guacamole);
        //$MAPS->addSandwichIngredient(Ingredient $parmesan);
        $MAPS->setDescription(5);
        $MAPS->setPrice(mt_rand(0,5));
        $manager->persist($MAPS);

        $royal = new OriginalSandwich();
        $royal->setName('Le royal');
        $royal->setPrice(mt_rand(0,5));
        $royal->setDescription(5);
        $manager->persist($royal);

        $manager->flush();
    }
}