<?php

namespace Order;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Order\InOrder;
use StarLei\Msuncloud\Order\InOrderById;
use Throwable;

class InOrderByIdTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new InOrderById($config);
        try {
            $data = [
                'orderMainIdList'=> [6069876854083029256],
            ];
            var_dump($client->index($data));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}