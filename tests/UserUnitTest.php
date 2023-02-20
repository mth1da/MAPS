<?php

namespace App\Tests;

use App\Entity\Publication;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $user = new User();
        $birthdate = new \DateTimeImmutable();
        $createdAt = new \DateTimeImmutable();

        $user->setEmail('email@test.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword('password');
        $user->setFirstName('Bon');
        $user->setLastName('Jour');
        $user->setUserName('bonjour');
        $user->setBirthDate($birthdate);
        $user->setCreatedAt($createdAt);

        $this->assertTrue($user->getEmail() === 'email@test.com');
        $this->assertTrue($user->getRoles() === ['ROLE_USER']);
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getFirstName() === 'Bon');
        $this->assertTrue($user->getLastName() === 'Jour');
        $this->assertTrue($user->getUserName() === 'bonjour');
        $this->assertTrue($user->getBirthDate() === $birthdate);
        $this->assertTrue($user->getCreatedAt() === $createdAt);

    }

    public function testIsFalse()
    {
        $user = new User();
        $birthdate = new \DateTimeImmutable();
        $createdAt = new \DateTimeImmutable();

        $user->setEmail('email@test.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword('password');
        $user->setFirstName('Bon');
        $user->setLastName('Jour');
        $user->setUserName('bonjour');
        $user->setBirthDate($birthdate);
        $user->setCreatedAt($createdAt);

        $this->assertFalse($user->getEmail() === 'test@test.com');
        $this->assertFalse($user->getRoles() === ['ROLE_ADMIN']);
        $this->assertFalse($user->getPassword() === 'motdepasse');
        $this->assertFalse($user->getFirstName() === 'Bone');
        $this->assertFalse($user->getLastName() === 'Soir');
        $this->assertFalse($user->getUserName() === 'bonsoir');
        $this->assertFalse($user->getBirthDate() === '1888-01-02');
        $this->assertFalse($user->getCreatedAt() === '1666-11-11');

    }

    public function testAddPublication()
    {
        $user = new User();
        $publi = new Publication();

        $user->addPublication($publi);
        $this->assertContains($publi, $user->getPublications());
    }
}
