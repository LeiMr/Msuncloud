<?php

namespace Lis;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\History\Content;
use StarLei\Msuncloud\History\Menus;
use StarLei\Msuncloud\Lis\Applies;
use StarLei\Msuncloud\Lis\AppliesItem;
use StarLei\Msuncloud\Lis\Details;
use StarLei\Msuncloud\Lis\Reports;
use StarLei\Msuncloud\Medical\BatchOrder;
use StarLei\Msuncloud\Medical\Patient;
use StarLei\Msuncloud\Order\InOrder;
use Throwable;

class AppliesItemTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new AppliesItem($config);
        try {
            var_dump($client->index());
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}