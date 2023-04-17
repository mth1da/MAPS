<?php

namespace App\DataFixtures;

use App\Entity\Table;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TableFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $table1 = new Table();
        $table1->setNbSeat(2);
        $table1->setLocation("vue sur paris");
        $manager->persist($table1);

        $table2 = new Table();
        $table2->setNbSeat(2);
        $table2->setLocation("près du comptoir");
        $manager->persist($table2);

        $table3 = new Table();
        $table3->setNbSeat(4);
        $table3->setLocation("près de la cheminée");
        $manager->persist($table3);

        $table4 = new Table();
        $table4->setNbSeat(6);
        $table4->setLocation("vue sur la seine");
        $manager->persist($table4);

        //reference pour les réservations fixtures
        $this->addReference('table1', $table1);
        $this->addReference('table2', $table2);
        $this->addReference('table3', $table3);
        $this->addReference('table4', $table4);

        $manager->flush();
    }
}
