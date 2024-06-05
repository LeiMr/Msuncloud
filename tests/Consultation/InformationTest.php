<?php

namespace Consultation;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Consultation\Details;
use StarLei\Msuncloud\Consultation\Information;
use StarLei\Msuncloud\Consultation\Lists;
use Throwable;

class InformationTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new Information($config);
        try {
            var_dump($client->index(6103985622138750593));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}