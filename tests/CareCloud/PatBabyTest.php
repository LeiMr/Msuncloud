<?php

namespace CareCloud;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\CareCloud\PatBaby;
use StarLei\Msuncloud\CareCloud\Patient;
use Throwable;

class PatBabyTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new PatBaby($config);
        try {
            $data = [
                'patInHosId'=>'6069873196353587459',
            ];
            var_dump($client->index($data,4901127357031780230));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}