<?php

namespace CareCloud;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\CareCloud\Bed;
use StarLei\Msuncloud\CareCloud\ChangeBed;
use StarLei\Msuncloud\CareCloud\ChangeDept;
use StarLei\Msuncloud\CareCloud\ChangeWard;
use Throwable;

class ChangeBedTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new ChangeBed($config);
        try {
            $data = [
                'beginDate'=>"2023-01-12 00:00:00",
                'endDate'=> "2023-02-12 00:00:00"
            ];
            var_dump($client->index($data));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}