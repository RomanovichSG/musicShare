<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class userControllerTest extends WebTestCase
{
    public function testRegistration()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/registration');
    }

    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
    }

}
