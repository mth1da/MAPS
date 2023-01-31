<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Type;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $type = new Type();
        $type->setName('Pain');

        //enregistre les modifs
        $manager->persist($type);

        //envoie à la bdd
        $manager->flush();
    }
}
