<?php

namespace Diagnosis;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Diagnosis\Diagnosis;
use StarLei\Msuncloud\Diagnosis\FindPatAllDiagnosis;
use Throwable;

class DiagnosisTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new Diagnosis($config);
        try {
            $data = [
                'patId'=> 6069873196353587459,
                'patInHosId'=> 6069876854083029256,
                'diagnoseSource'=> 3,
            ];
            var_dump($client->index($data));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}