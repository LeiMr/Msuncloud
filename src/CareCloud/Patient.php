<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\CareCloud;

use GuzzleHttp\Exception\GuzzleException;
use StarLei\Msuncloud\HttpClient;
use StarLei\Msuncloud\Kernel\Exceptions\Exception;
use StarLei\Msuncloud\Kernel\Exceptions\HttpException;
use StarLei\Msuncloud\Kernel\Exceptions\InvalidConfigException;
use StarLei\Msuncloud\Kernel\Traits\BusinessResponse;
use StarLei\Msuncloud\Kernel\Traits\ResponseCastable;

/**
 * 2.2.3. 住院患者基本信息查询
 * Class Patient
 * @package StarLei\Msuncloud\CareCloud
 */
class Patient
{
    use BusinessResponse, ResponseCastable;

    /**
     * @var string
     */
    private $path = '/msun-middle-aggregate-hsz/v1/patients';
    /**
     * @var HttpClient
     */
    private $client;
    /**
     * @var array
     */
    private $required = ['wardId', 'deptId', 'patId', 'patInHosCode', 'patInHosId'];

    /**
     * Dept constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->client = new HttpClient($config);
    }

    /**
     * @param $params
     * @return array
     * @throws GuzzleException
     * @throws HttpException
     * @throws InvalidConfigException|Exception
     */
    public function index($params = []): array
    {
        $requiredArr = only($params, $this->required);
        if (empty($requiredArr)) {
            throw new Exception('缺少必要的参数');
        }
        return $this->toArray($this->client->get($this->path, $params));
    }

    /**
     * @param $params
     * @return array
     * @throws HttpException
     * @throws Exception
     */
    public function batchQuery($params = []): array
    {
        $request = [];
        foreach ($params as $item) {
            $request[] = [
                'path' => $this->path,
                'data' => $item,
                'method' => 'GET',
            ];
        }
        $data = [];
        $this->client->async($request,
            function ($response, $index) use (&$data) {
                // 此处处理每个请求的成功响应
                //echo "请求 #{$index} 查看成功。";
                $data[] = $this->toArray($this->castResponseToType($response));
            },
            function ($reason, $index) {
                // 此处处理每个请求的失败
                //echo "请求 #{$index} 失败，原因: " . $reason->getMessage() . PHP_EOL;
            });
        return $data;
    }

}