<?php

namespace History;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\History\Content;
use StarLei\Msuncloud\History\Menus;
use StarLei\Msuncloud\Medical\BatchOrder;
use StarLei\Msuncloud\Medical\Patient;
use StarLei\Msuncloud\Order\InOrder;
use Throwable;

class ContentTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new Content($config);
        try {
            $data = [
                'mrTypeId' => 'A0102001',
                'noteId'=> '6069876854083029256',
                'babyId'=>  0,
            ];
            var_dump($client->index($data));
        } catch (Throwable $e) {
            var_dump("失败:" . $e->getMessage());
        }
    }
}