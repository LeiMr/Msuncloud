<?php
namespace Dict;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Dict\Identity;

class IdentityTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
         $client = new Identity($config);
        try {
            var_dump($client->index(['roleType'=>6]));
        }catch (\Throwable $e){
            var_dump("失败:".$e->getMessage());
        }
    }
}