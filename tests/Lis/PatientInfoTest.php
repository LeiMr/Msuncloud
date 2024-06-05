<?php

namespace Lis;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Lis\PatientInfo;

use Throwable;

class PatientInfoTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new PatientInfo($config);
        try {
            $data = [
                'patNo' => 23510482,
                'patType' => 1
            ];
            var_dump($client->index($data));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}