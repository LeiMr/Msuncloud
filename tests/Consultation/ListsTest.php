<?php

namespace Consultation;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Consultation\Lists;
use Throwable;

class ListsTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new Lists($config);
        try {
            var_dump($client->index());
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}