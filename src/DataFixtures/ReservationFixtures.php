<?php

namespace App\DataFixtures;

use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReservationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $resa1 = new Reservation();
        $resa1->setResaTable(
            $this->getReference('table1')
        );
        $resa1->setDateTimeReservation((new \DateTime('22-04-2023 12:15')));
        $manager->persist($resa1);

        $resa2 = new Reservation();
        $resa2->setResaTable(
            $this->getReference('table2')
        );
        $resa2->setDateTimeReservation((new \DateTime('22-04-2023 14:00')));
        $manager->persist($resa2);

        $resa3 = new Reservation();
        $resa3->setResaTable(
            $this->getReference('table3')
        );
        $resa3->setDateTimeReservation((new \DateTime('22-04-2023 13:30')));
        $manager->persist($resa3);

        $resa4 = new Reservation();
        $resa4->setResaTable(
            $this->getReference('table4')
        );
        $resa4->setDateTimeReservation((new \DateTime('22-04-2023 12:00')));
        $manager->persist($resa4);

        $resa5 = new Reservation();
        $resa5->setResaTable(
            $this->getReference('table1')
        );
        $resa5->setDateTimeReservation((new \DateTime('29-04-2023 12:45')));
        $manager->persist($resa5);

        $resa6 = new Reservation();
        $resa6->setResaTable(
            $this->getReference('table2')
        );
        $resa6->setDateTimeReservation((new \DateTime('29-04-2023 13:00')));
        $manager->persist($resa6);

        $resa7 = new Reservation();
        $resa7->setResaTable(
            $this->getReference('table3')
        );
        $resa7->setDateTimeReservation((new \DateTime('06-05-2023 13:10')));
        $manager->persist($resa7);

        $resa8 = new Reservation();
        $resa8->setResaTable(
            $this->getReference('table1')
        );
        $resa8->setDateTimeReservation((new \DateTime('06-05-2023 12:30')));
        $manager->persist($resa8);

        $resa9 = new Reservation();
        $resa9->setResaTable(
            $this->getReference('table4')
        );
        $resa9->setDateTimeReservation((new \DateTime('13-05-2023 11:50')));
        $manager->persist($resa9);

        $resa10 = new Reservation();
        $resa10->setResaTable(
            $this->getReference('table2')
        );
        $resa10->setDateTimeReservation((new \DateTime('13-05-2023 12:45')));
        $manager->persist($resa10);

        $manager->flush();
    }

    //Table fixtures doit être executée avant réservation fixtures
    public function getDependencies(): array
    {
        return [
            TableFixtures::class
        ];
    }
}
