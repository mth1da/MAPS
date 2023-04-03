<?php

namespace App\DataFixtures;

use App\Entity\Publication;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PublicationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $publi1 = new Publication();
        $publi1->setPubliUser(
            $this->getReference('user5')
        );
        $publi1->setPhoto("publication1.webp");
        $publi1->setCommentaire('première fois chez MAPS et certainement pas la dernière ! leurs sandwichs sont juste fabuleux, MERCI');
        $date = new \DateTimeImmutable('2023-02-10');
        $newDate = $date->setTime(14, 39, 4);
        $publi1->setCreatedAt($newDate);
        //enregistre les modifs
        $manager->persist($publi1);

        $publi2 = new Publication();
        $publi2->setPubliUser(
            $this->getReference('user6')
        );
        $publi2->setPhoto("publication2.jpg");
        $publi2->setCommentaire('j\'adore');
        $date = new \DateTimeImmutable('2023-04-02');
        $newDate = $date->setTime(19, 10, 55);
        $publi2->setCreatedAt($newDate);
        $manager->persist($publi2);


        $manager->flush();
    }

    //UserFixtures doit être executé avant PublicationFixtures
    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
