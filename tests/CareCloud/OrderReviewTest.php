<?php
namespace CareCloud;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\CareCloud\BatchPatBaby;
use StarLei\Msuncloud\CareCloud\OrderReview;

class OrderReviewTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new OrderReview($config);
        try {
            $data = [
                'exeDeptId'=> 4844164144023339020
            ];
            var_dump($client->index($data,4901127357031780230));
        }catch (\Throwable $e){
            var_dump("失败:".$e->getMessage());
        }
    }
}