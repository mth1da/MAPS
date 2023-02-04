<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Faker;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher){}

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@gmail.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
            $this->passwordHasher->hashPassword($admin, 'admin')
        );
        $admin->setFirstName('Mathilde');
        $admin->setLastName('Turra');
        $admin->setUserName('admin');
        $admin->setBirthDate(new \DateTime('15-11-2002'));
        $admin->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($admin);

        //creation de 5 faux users
        $faker = Faker\Factory::create('fr_FR');
        for($usr=1; $usr<=5; $usr++){
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPassword(
                $this->passwordHasher->hashPassword($user, 'password')
            );
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setUserName($faker->userName);
            $user->setBirthDate($faker->dateTime);
            $user->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($user);
        }

        $manager->flush();
    }
}
