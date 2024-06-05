<?php

namespace Lis;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Lis\PatientApplies;
use StarLei\Msuncloud\Lis\PatientInfo;

use Throwable;

class PatientAppliesTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new PatientApplies($config);
        try {
            $data = [
                'beginTime' => '2023-06-01 00:00:00',
                'endTime' => '2023-06-30 00:00:00',
            ];
            var_dump($client->index($data));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}