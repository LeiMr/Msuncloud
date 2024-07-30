<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\Kernel\Traits;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

trait HasHttpRequests
{
    use ResponseCastable, MiddlewareDebug;

    /**
     * @var array
     */
    protected static $defaults = [
        'curl' => [
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
        ],
    ];
    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @param string $url
     * @param string $method
     * @param array $options
     * @param bool $debug
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function request(string $url, string $method = 'GET', array $options = [], $debug = false): ResponseInterface
    {
        $method = strtoupper($method);

        $options = array_merge(self::$defaults, $options);

        $options = $this->fixJsonIssue($options);
        $response = $this->getHttpClient($debug)->request($method, $url, $options);
        $response->getBody()->rewind();
        return $response;
    }

    /**
     * @param array $options
     *
     * @return array
     */
    protected function fixJsonIssue(array $options): array
    {
        if (isset($options['json']) && is_array($options['json'])) {
            $options['headers'] = array_merge($options['headers'] ?? [], ['Content-Type' => 'application/json']);

            if (empty($options['json'])) {
                $options['body'] = \GuzzleHttp\json_encode($options['json'], JSON_FORCE_OBJECT);
            } else {
                $options['body'] = \GuzzleHttp\json_encode($options['json'], JSON_UNESCAPED_UNICODE);
            }

            unset($options['json']);
        }

        return $options;
    }

    /**
     * Return GuzzleHttp\ClientInterface instance.
     *
     * @param bool $debug
     * @return ClientInterface
     */
    public function getHttpClient($debug = false): ClientInterface
    {
        if (!($this->httpClient instanceof ClientInterface)) {
            $middleware = [];
            $debug && $middleware['handler'] = $this->bugPrint();
            $this->httpClient = new Client($middleware);
        }

        return $this->httpClient;
    }

    /**
     * @param array $requests
     * @param Closure $success
     * @param Closure $error
     * @param bool $debug
     */
    public function getHttpClientAsync(array $requests,Closure $success, Closure $error, bool $debug = false)
    {
        $client = $this->getHttpClient($debug);
        $request = function ($requests) {
            foreach ($requests as $request) {
                $method = strtoupper($request['method']);
                $options = array_merge(self::$defaults, $request);
                $options = $this->fixJsonIssue($options);
                $url = $options['url'] ?? '';
                $header = $options['headers'] ?? [];
                $body = $options['body'] ?? null;
                yield new Request($method, $url,$header,$body);
            }
        };
        // 创建并发请求池
        $pool = new Pool($client, $request($requests), [
            'concurrency' => 20,
            'fulfilled' => $success,
            'rejected' => $error,
        ]);
        // 等待所有请求执行完毕
        $promise = $pool->promise();
        $promise->wait();
    }



}