<?php

namespace CareCloud;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\CareCloud\Patient;
use Throwable;

class PatientTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new Patient($config);
        try {
            //只查询一个
            $data = [
                'patInHosId'=>'6069876854083029256',
                'patStatus'=> 1,
            ];
            var_dump($client->index($data));
            //想查多个或者全部
            $data2 =[[
                'wardId'=>'5388500104015381261',
                'patStatus'=> 1,
            ],[
                'wardId'=>'5385466310352568322',
                'patStatus'=> 1,
            ]];
            var_dump($client->batchQuery($data2));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}