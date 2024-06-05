<?php
declare(strict_types=1);

namespace StarLei\Msuncloud;


use Closure;
use GuzzleHttp\Exception\GuzzleException;
use StarLei\Msuncloud\Kernel\BaseClient;


class HttpClient extends BaseClient
{

    /**
     * get请求
     * @param string $path
     * @param array $params
     * @return array
     * @throws GuzzleException
     * @throws Kernel\Exceptions\InvalidConfigException|Kernel\Exceptions\HttpException
     */
    public function get(string $path, array $params = []): array
    {
        list($url, $options) = $this->generation($path, $params);
        return $this->request($url, 'GET', $options);
    }

    /**
     * post请求
     * @param string $path
     * @param array $params
     * @return array
     * @throws GuzzleException
     * @throws Kernel\Exceptions\InvalidConfigException|Kernel\Exceptions\HttpException
     */
    public function post(string $path, array $params = []): array
    {
        list($url, $options) = $this->generation($path, $params, 'POST');
        return $this->request($url, 'POST', $options);
    }


    /**
     * 异步请求
     * @param array $params
     * @param Closure $success
     * @param Closure $error
     * @throws Kernel\Exceptions\HttpException
     */
    public function async(array $params,Closure $success, Closure $error)
    {
        $curls = [];
        foreach ($params as $item){
            list($url, $options)= $this->generation($item['path'], $item['data'], $item['method']);
            $curls[] = [
                'url' => $url,
                'headers' => $options['headers'],
                'body' =>$options['body'] ?? null,
                'method' => $item['method']
            ];
        }
       $this->asyncRequest($curls, $success, $error);
    }
}