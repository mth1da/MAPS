<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class UserFixtures extends Fixture
{

    const USER = [
        [
            "email" => "mathilde@admin.com",
            "password" => "admin",
            "roles" => "ROLE_ADMIN",
            "lastName" => "Turra",
            "firstName" => "Mathilde",
            "userName" => "mathilde",
            "birthday" => '15-11-2002',
        ],
        [
            "email" => "pauline@admin.com",
            "password" => "admin",
            "roles" => "ROLE_ADMIN",
            "lastName" => "Auda",
            "firstName" => "Pauline",
            "userName" => "pauline",
            "birthday" => '09-02-2001',
        ],
        [
            "email" => "samra@admin.com",
            "password" => "admin",
            "roles" => "ROLE_ADMIN",
            "lastName" => "Abdul",
            "firstName" => "Samra",
            "userName" => "samra",
            "birthday" => '13-09-2001',
        ],
        [
            "email" => "amandine@admin.com",
            "password" => "admin",
            "roles" => "ROLE_ADMIN",
            "lastName" => "Bremont",
            "firstName" => "Amandine",
            "userName" => "amandine",
            "birthday" => '30-03-2000',
        ],
        [
            "email" => "user@user.com",
            "password" => "user5",
            "roles" => "ROLE_USER",
            "lastName" => "Donne",
            "firstName" => "John",
            "userName" => "user",
            "birthday" => '23-01-1998',
        ]
    ];


    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ){}

    public function load(ObjectManager $manager): void
    {
        $count=1;
        foreach (self::USER as $key => $user) {
            $newUser = new User();
            $newUser
                ->setEmail($user['email'])
                ->setPassword($this->passwordHasher->hashPassword(
                    $newUser,
                    $user['password']
                ))
                ->setRoles([$user['roles']])
                ->setUserName($user['userName'])
                ->setLastName($user['lastName'])
                ->setFirstName($user['firstName'])
                ->setBirthDate((new \DateTime($user['birthday'])));
            $manager->persist($newUser);
            $this->addReference('user'.$count, $newUser);
            $count++;
        }


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
            $this->addReference('user'.$count, $user);
            $count++;
        }

        $manager->flush();
    }
}
