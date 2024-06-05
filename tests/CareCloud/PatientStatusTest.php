<?php

namespace CareCloud;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\CareCloud\PatientStatus;
use Throwable;

class PatientStatusTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new PatientStatus($config);
        try {
            $data = [
                6156808246982347000,
                6069876854083029256
            ];
            var_dump($client->index($data,4901127357031780230));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}