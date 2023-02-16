<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class TypeFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger ){}

    public function load(ObjectManager $manager): void
    {
        $pain = new Type();
        $pain->setName('Pain');
        $pain->setSlug($this->slugger->slug($pain->getName())->lower());
        //enregistre les modifs
        $manager->persist($pain);

        $viande = new Type();
        $viande->setName('Viande');
        $viande->setSlug($this->slugger->slug($viande->getName())->lower());
        $manager->persist($viande);

        $poisson = new Type();
        $poisson->setName('Poisson');
        $poisson->setSlug($this->slugger->slug($poisson->getName())->lower());
        $manager->persist($poisson);

        $crudite = new Type();
        $crudite->setName('Crudités');
        $crudite->setSlug($this->slugger->slug($crudite->getName())->lower());
        $manager->persist($crudite);

        $fromage = new Type();
        $fromage->setName('Fromage');
        $fromage->setSlug($this->slugger->slug($fromage->getName())->lower());
        $manager->persist($fromage);

        $plante = new Type();
        $plante->setName('Plante');
        $plante->setSlug($this->slugger->slug($plante->getName())->lower());
        $manager->persist($plante);

        $epice = new Type();
        $epice->setName('Epice');
        $epice->setSlug($this->slugger->slug($epice->getName())->lower());
        $manager->persist($epice);

        $sauce = new Type();
        $sauce->setName('Sauce');
        $sauce->setSlug($this->slugger->slug($sauce->getName())->lower());
        $manager->persist($sauce);

        //reference pour le ingredient fixtures
        $this->addReference('pain', $pain);
        $this->addReference('viande', $viande);
        $this->addReference('poisson', $poisson);
        $this->addReference('crudite', $crudite);
        $this->addReference('fromage', $fromage);
        $this->addReference('plante', $plante);
        $this->addReference('epice', $epice);
        $this->addReference('sauce', $sauce);

        //envoie à la bdd
        $manager->flush();
    }
}
