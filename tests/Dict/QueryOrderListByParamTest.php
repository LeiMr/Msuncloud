<?php

namespace Dict;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\Dict\QueryOrderListByParam;
use Throwable;

class QueryOrderListByParamTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new QueryOrderListByParam($config);
        try {
            var_dump($client->index());
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}