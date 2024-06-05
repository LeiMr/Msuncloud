<?php

namespace Order;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Order\ApplyItem;
use StarLei\Msuncloud\Order\InOrder;
use Throwable;

class ApplyItemTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new ApplyItem($config);
        try {
            $data = [
                'patId'=>"6069873196353587459",
                'medicalServiceId'=> "6069876854083029256"
            ];
            var_dump($client->index($data));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}