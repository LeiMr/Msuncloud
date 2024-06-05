<?php

namespace CareCloud;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\CareCloud\ChangePatient;
use StarLei\Msuncloud\CareCloud\Patient;
use Throwable;

class ChangePatientTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new ChangePatient($config);
        try {
            var_dump($client->index(6069873196353587459,4901127357031780230));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}