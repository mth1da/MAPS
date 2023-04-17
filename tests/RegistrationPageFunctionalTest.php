<?php

namespace App\Tests;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationPageFunctionalTest extends WebTestCase
{
    public function testCreateNewUser(): void
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/register', [
            'user_name' => 'alys',
            'first_name' => 'pauline',
            'last_name' => 'pauline',
            'birth_date' => '09/02/2011',
            'email' => 'pauline.auda@free.fr',
            'password' => 'password',
        ]);
        $this->assertResponseRedirects('/login');
    }

}
