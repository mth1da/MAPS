<?php

namespace App\DataFixtures;

use App\Entity\OriginalSandwich;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Sandwich;
use Symfony\Component\String\Slugger\SluggerInterface;
class SandwichOriginalFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $MAPS = new Sandwich();
        $MAPS->setName('MAPS');
        //$MAPS->setPrice(mt_rand(0,5));
        $manager->persist($MAPS);

        $royal = new Sandwich();
        $royal->setName('Le royal');
        $manager->persist($royal);

        $manager->flush();
    }
}