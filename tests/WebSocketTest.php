<?php


use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\WebSocketClient;

class WebSocketTest extends TestCase
{
    /**
     * @throws \StarLei\Msuncloud\Kernel\Exceptions\HttpException
     */
    public function testWebSocket()
    {
        $config = require('Conf\config.php');
        $client = new WebSocketClient($config);
        //获取住院患者信息
        $patient =array(
            'clientId'=> 'thirdpart-graytest.msunhis.com',
            'appName'=> 'open-platform-lis',
            'busiName'=> 'sendBarcodeInfo',
            'storage'=> true
        );
        $webSocketClient = $client->socket($patient);
        $webSocketClient->sendMessage("Test message");
        // 等待服务器响应
        $response = $webSocketClient->receiveMessage();

        //// 断言连接是否成功
        //$this->assertNotEmpty($response, "WebSocket connection successful");

        // 关闭连接
        //$webSocketClient->closeConnection();
        // 设置消息接收回调函数
        $webSocketClient->setMessageCallback(function($message) {
            //echo "Received message: " . $message . "\n";
        });
         //自动重新连接
        $webSocketClient->autoReconnect();
        //开始监听消息
        $webSocketClient->listen();
    }
}