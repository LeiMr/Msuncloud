<?php

namespace Dict;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Dict\WardToDept;
use Throwable;

class WardToDeptTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new WardToDept($config);
        try {
            var_dump($client->index());
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}