<?php

namespace CareCloud;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\CareCloud\Bed;
use Throwable;

class BedTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new Bed($config);
        try {
            $data = [
                'wardId'=>'997'
            ];
            var_dump($client->index($data));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}