<?php

namespace Consultation;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Consultation\Details;
use StarLei\Msuncloud\Consultation\Lists;
use Throwable;

class DetailsTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new Details($config);
        try {
            var_dump($client->index(6103985622138750593));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}