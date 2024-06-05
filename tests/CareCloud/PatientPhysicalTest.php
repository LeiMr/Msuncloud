<?php
namespace CareCloud;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\CareCloud\PatientPhysical;

class PatientPhysicalTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new PatientPhysical($config);
        try {
            $data = [
                'patInHosId'=> '6240820188201879680',
            ];
            var_dump($client->index($data));
        }catch (\Throwable $e){
            var_dump("失败:".$e->getMessage());
        }
    }
}