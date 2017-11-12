<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class roomControllerTest extends WebTestCase
{
    public function testPlatform()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/platform');
    }

}
