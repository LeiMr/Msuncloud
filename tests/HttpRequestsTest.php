<?php


use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\HttpClient;

class HttpRequestsTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require'Conf\config.php';
        $client = new HttpClient($config);
        $data = [
            'deptId'=>'4844132434212683784',
            'startDate'=> '2000-01-01 00:00:00',
            'endDate' => '2024-07-31 23:59:59',
            'type' => 1
        ];

        //获取科室信息
        $response = $client->post('/msun-middle-aggregate-clinic/v1/out-visit-records',$data);
        var_dump($response);exit;

    }
}