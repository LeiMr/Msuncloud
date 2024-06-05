<?php

namespace History;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\History\Content;
use StarLei\Msuncloud\History\Menus;
use StarLei\Msuncloud\History\Struct;
use StarLei\Msuncloud\Medical\BatchOrder;
use StarLei\Msuncloud\Medical\Patient;
use StarLei\Msuncloud\Order\InOrder;
use Throwable;

class StructTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new Struct($config);
        try {
            $data = [
                'patInHosId' => 6069876854083029256
            ];
            var_dump($client->index($data));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}