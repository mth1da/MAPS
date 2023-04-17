<?php

namespace App\Tests;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginFunctionalTest extends WebTestCase
{
    public function testLoginPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertResponseStatusCodeSame(200);
    }


    public function testH1LoginPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertSelectorTextContains('h1', 'Connexion à mon compte');
    }

    public function testLogoutStatus(): void
    {
        $client = static::createClient();
        $client->request('GET', '/logout');
        $this->assertResponseStatusCodeSame(302);
    }

}
