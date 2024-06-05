<?php

namespace Medical;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Medical\BatchOrder;
use StarLei\Msuncloud\Medical\Patient;
use StarLei\Msuncloud\Order\InOrder;
use Throwable;

class BatchOrderTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new BatchOrder($config);
        try {
            $data = [
                'patId' => 5725009232234415624,
                'startTime'=>  date('Y-m-d H:i:s', strtotime('-365 days')),
                'endTime'=>  date('Y-m-d H:i:s', time() - 3599),
            ];
            var_dump($client->index($data));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}