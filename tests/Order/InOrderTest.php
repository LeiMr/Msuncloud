<?php

namespace Order;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Order\InOrder;
use Throwable;

class InOrderTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new InOrder($config);
        try {
            $data = [
                'patInHosId'=>"6240820188201879680",
                'orderType'=> "0"
            ];
            var_dump($client->index($data));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}