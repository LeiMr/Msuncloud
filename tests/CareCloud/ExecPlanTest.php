<?php

namespace CareCloud;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\CareCloud\Bed;
use StarLei\Msuncloud\CareCloud\ExecPlan;
use Throwable;

class ExecPlanTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new ExecPlan($config);
        try {
            $data = [
                'orderMainId'=> '6069873196353587459',
                'pageNum'=> 1,
                'pageSize' => 10
            ];
            var_dump($client->index($data,4901127357031780230));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}