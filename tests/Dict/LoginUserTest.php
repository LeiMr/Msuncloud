<?php

namespace Dict;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Dict\LoginUser;
use StarLei\Msuncloud\Dict\User;
use Throwable;

class LoginUserTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new LoginUser($config);
        try {
            var_dump($client->index('4901127357031780230'));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}