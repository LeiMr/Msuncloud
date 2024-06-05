<?php

namespace Diagnosis;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Consultation\Lists;
use StarLei\Msuncloud\Diagnosis\FindPatAllDiagnosis;
use Throwable;

class FindPatAllDiagnosisTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new FindPatAllDiagnosis($config);
        try {
            $data = [
                'patInHosIdList'=> [5828452732638857349],
            ];
            var_dump($client->index($data));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}