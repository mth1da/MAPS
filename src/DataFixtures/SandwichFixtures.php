<?php

namespace App\DataFixtures;

use App\Entity\OriginalSandwich;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Sandwich;
use phpDocumentor\Reflection\Types\True_;
use Symfony\Component\String\Slugger\SluggerInterface;
class SandwichFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $MAPS = new Sandwich();
        $MAPS->setName('Le MAPS');
        $MAPS->setIsOriginal(True);
        $MAPS->setPrice(500);
        $manager->persist($MAPS);

        $royal = new Sandwich();
        $royal->setName('Le Royal');
        $royal->setPrice(500);
        $royal->setIsOriginal(True);
        $manager->persist($royal);

        $JB = new Sandwich();
        $JB->setName('Le Jambon-Beurre');
        $JB->setPrice(300);
        $JB->setIsOriginal(True);
        $manager->persist($JB);

        $manager->flush();
    }
}