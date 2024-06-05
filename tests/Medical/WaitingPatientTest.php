<?php


namespace Medical;


use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Medical\WaitingPatient;
use Throwable;

class WaitingPatientTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new WaitingPatient($config);
        try {
            $data = [
                'tab' => 2,
                'callerCode' => 'mzemr',
                'qeryTime'=>  date('Y-m-d', strtotime('-365 days')),
                'callStatus'=> 0,
                'endTime'=>  date('Y-m-d', time()),
                'beginTime'=> '2023-03-20',
                'deptId'=> -999123
            ];
            var_dump($client->index($data,4901127357031780230));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}