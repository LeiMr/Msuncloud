<?php

namespace History;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\History\Menus;
use StarLei\Msuncloud\Medical\BatchOrder;
use StarLei\Msuncloud\Medical\Patient;
use StarLei\Msuncloud\Order\InOrder;
use Throwable;

class MenusTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new Menus($config);
        try {
            $data = [
                'menuCode' => 'A0102004',
                'patInHosId'=> 6069876854083029256,
                'babyId'=>  0,
                'isProcess'=> 0,
            ];
            var_dump($client->index($data));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}