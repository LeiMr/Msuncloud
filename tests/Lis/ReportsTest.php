<?php

namespace Lis;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\History\Content;
use StarLei\Msuncloud\History\Menus;
use StarLei\Msuncloud\Lis\Reports;
use StarLei\Msuncloud\Medical\BatchOrder;
use StarLei\Msuncloud\Medical\Patient;
use StarLei\Msuncloud\Order\InOrder;
use Throwable;

class ReportsTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new Reports($config);
        try {
            $data = [
                'startTime' => '2023-06-01 00:00:00',
                'endTime'=> '2023-06-30 00:00:00',
            ];
            var_dump(json_encode($client->index($data)));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}