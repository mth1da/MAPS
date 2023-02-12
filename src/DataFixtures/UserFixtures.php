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
            "email" => "admin@admin.com",
            "password" => "admin",
            "roles" => "ROLE_ADMIN",
            "lastName" => "Doe",
            "firstName" => "John",
            "userName" => "admin",
            "birthday" => '02/04/1995',
        ],
        [
            "email" => "user@user.com",
            "password" => "user",
            "roles" => "ROLE_USER",
            "lastName" => "Izu",
            "firstName" => "Maki",
            "userName" => "user",
            "birthday" => '23/01/1998',
        ]
    ];
    
    public UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
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
                ->setBirthDate((new \DateTimeImmutable()));
            $manager->persist($newUser);
        }


        /*
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
    */
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
