<?php

namespace MarketplaceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MarketControllerControllerTest extends WebTestCase
{
    public function testListloans()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/listLoans');
    }

}
