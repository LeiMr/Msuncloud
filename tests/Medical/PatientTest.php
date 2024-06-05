<?php

namespace Medical;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Medical\Patient;
use StarLei\Msuncloud\Order\InOrder;
use Throwable;

class PatientTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new Patient($config);
        try {
            $data = [
                'deptId' => '-999123',
                'startDate'=>  date('Y-m-d H:i:s', strtotime('-365 days')),
                'endDate'=>  date('Y-m-d H:i:s', time() - 3599),
                'type'=> 1
            ];
            var_dump($client->index($data,4901127357031780230));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}