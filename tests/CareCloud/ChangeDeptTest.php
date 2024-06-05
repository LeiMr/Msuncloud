<?php

namespace CareCloud;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\CareCloud\Bed;
use StarLei\Msuncloud\CareCloud\ChangeDept;
use Throwable;

class ChangeDeptTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new ChangeDept($config);
        try {
            $data = [
                'patInHosIds'=> ['5828452732638857349'],
                'completeFlag'=> 0
            ];
            var_dump($client->index($data,4901127357031780230));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}