<?php

namespace Dict;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Dict\Hospital;

class HospitalTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new Hospital($config);
        try {
            var_dump($client->index());
        } catch (\Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}