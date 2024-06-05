<?php
declare(strict_types=1);

namespace StarLei\Msuncloud;

use StarLei\Msuncloud\Kernel\BaseClient;
use StarLei\Msuncloud\Kernel\Exceptions\HttpException;
use Throwable;
use WebSocket\Client;

class WebSocketClient extends BaseClient
{

    private $client;
    private $reconnectInterval = 30;
    private $messageCallback; // 消息接收回调函数

    /**
     * 推送消息
     * @param string $message
     */
    public function sendMessage(string $message)
    {
        $this->client->send($message);
    }

    /**
     * 接收消息
     * @return mixed
     */
    public function receiveMessage()
    {
        return $this->client->receive();
    }

    /**
     * 关闭链接
     */
    public function closeConnection()
    {
        $this->client->close();
    }

    /**
     * 设置消息接收回调函数
     * @param callable $callback
     */
    public function setMessageCallback(callable $callback)
    {
        $this->messageCallback = $callback;
    }

    /**
     * 设置重连时间
     * @param int $reconnectInterval
     */
    public function setReconnectInterval(int $reconnectInterval)
    {
        $this->reconnectInterval = $reconnectInterval;
    }

    /**
     * 重新链接
     */
    public function autoReconnect()
    {
        while (true) {
            try {
                if (!$this->client->isConnected()) {
                    $this->socket();
                }
                // 这里可以添加一些心跳检测或者其他自动重连的逻辑
                sleep($this->reconnectInterval); // 例如每隔5秒重新连接一次
            } catch (Throwable $e) {
                // 处理连接失败的异常
                // 这里可以记录日志或者采取其他处理措施
                echo "Connection failed: " . $e->getMessage() . "\n";
            }
        }
    }

    /**
     * socket请求
     * @param array $params
     * @return WebSocketClient
     * @throws HttpException
     */
    public function socket(array $params = []): WebSocketClient
    {
        list($url) = $this->generation('', $params, 'SOCKET');
        return $this->connect($url);
    }

    // 监听消息

    /**
     * 创建链接实例
     * @param $url
     * @return $this
     */
    public function connect($url): WebSocketClient
    {
        $this->client = new Client($url);
        return $this;
    }

    public function listen()
    {
        while (true) {
            try {
                $message = $this->client->receive();
                if ($message !== null && $this->messageCallback !== null) {
                    // 调用回调函数处理消息
                    call_user_func($this->messageCallback, $message);
                }
            } catch (Throwable $e) {
                // 处理接收消息失败的异常
                // 这里可以记录日志或者采取其他处理措施
                echo "Failed to receive message: " . $e->getMessage() . "\n";
            }
        }
    }


}