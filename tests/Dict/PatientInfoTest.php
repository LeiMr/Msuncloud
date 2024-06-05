<?php
namespace Dict;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Dict\Dept;
use StarLei\Msuncloud\Dict\PatientInfo;

class PatientInfoTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new PatientInfo($config);
        try {
            $data  = [
                'cardNo' => '',
                'idCardNo' => '370102199209092344',
                'idCardType' => 0,
                'type' => 2,
                'patName'=>''
            ];
            var_dump($client->index(10001,$data));
        }catch (\Throwable $e){
            var_dump("失败:".$e->getMessage());
        }
    }
}