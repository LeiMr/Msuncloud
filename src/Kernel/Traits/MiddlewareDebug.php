<?php
declare(strict_types=1);
namespace StarLei\Msuncloud\Kernel\Traits;


use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Trait MiddlewareDebug
 * @package StarLei\Msuncloud\Kernel\Traits
 */
trait MiddlewareDebug
{
    /**
     * debug输出
     * @return HandlerStack
     */
    protected function bugPrint(): HandlerStack
    {
        // 创建 HandlerStack
        $stack = HandlerStack::create();
        // 添加 Middleware，在请求发送之前输出请求数据
        $stack->push(Middleware::mapRequest(function (RequestInterface $request, ResponseInterface $response = null) {
            $requestData = [
                'method' => $request->getMethod(),
                'uri' => (string)$request->getUri(),
                'headers' => $request->getHeaders(),
                'body' => (string)$request->getBody(),
            ];
            // 直接输出请求数据(为什么不写日志，因为我懒，而且测试时，直接看终端不好吗)
            var_dump("Request: " . json_encode($requestData, JSON_PRETTY_PRINT) . PHP_EOL);
            if ($response) {
                $responseData = [
                    'status' => $response->getStatusCode(),
                    'reason' => $response->getReasonPhrase(),
                    'headers' => $response->getHeaders(),
                    'body' => (string)$response->getBody(),
                ];
                // 直接输出响应数据
                var_dump("Response: " . json_encode($responseData, JSON_PRETTY_PRINT) . PHP_EOL);
            }
            return $request;
        }));
        return $stack;
    }
}
