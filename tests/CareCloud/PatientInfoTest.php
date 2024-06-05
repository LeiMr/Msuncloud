<?php

namespace CareCloud;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\CareCloud\PatientInfo;
use Throwable;

class PatientInfoTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new PatientInfo($config);
        try {
            $data = [
                'patIdList'=>['5776986839873488391'],
                //'patInTimeBegin'=> date('Y-m-d H:i:s', strtotime('-14 days')),
                //'patInTimeEnd' =>  date('Y-m-d H:i:s', time())
            ];
            var_dump($client->index($data,'4901127357031780230'));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}