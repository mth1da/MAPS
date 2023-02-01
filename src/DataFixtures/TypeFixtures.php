<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Type;
use Symfony\Component\String\Slugger\SluggerInterface;

class TypeFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger ){}

    public function load(ObjectManager $manager): void
    {
        $type = $this->createType('Pains', $manager);
        //<=> $type = $this->createType(name:'Pain', manager: $manager);

        $type = $this->createType('Viandes', $manager);

        $type = $this->createType('Poissons', $manager);

        $type = $this->createType('Crudités', $manager);

        $type = $this->createType('Fromages', $manager);

        $type = $this->createType('Plantes', $manager);

        $type = $this->createType('Epices', $manager);

        $type = $this->createType('Sauces', $manager);

        //envoie à la bdd
        $manager->flush();
    }

    public function createType (string $name, ObjectManager $manager){
        $type = new Type();
        $type->setName($name);
        $type->setSlug($this->slugger->slug($type->getName())->lower());
        //enregistre les modifs
        $manager->persist($type);
    }
}
