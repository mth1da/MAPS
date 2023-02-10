<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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
    public UserPasswordHasherInterface $passwordHash;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHash = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::USER as $key => $user) {
            $newUser = new User();
            $newUser
                ->setEmail($user['email'])
                ->setPassword($this->passwordHash->hashPassword(
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
        $manager->flush();
    }
}
