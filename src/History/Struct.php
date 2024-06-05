<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\History;

use GuzzleHttp\Exception\GuzzleException;
use StarLei\Msuncloud\HttpClient;
use StarLei\Msuncloud\Kernel\Exceptions\Exception;
use StarLei\Msuncloud\Kernel\Exceptions\HttpException;
use StarLei\Msuncloud\Kernel\Exceptions\InvalidConfigException;
use StarLei\Msuncloud\Kernel\Traits\BusinessResponse;

/**
 * 2.12.5. 查询病历内容
 * Class BatchOrder
 * @package StarLei\Msuncloud\History
 */
class Struct
{
    use BusinessResponse;

    /**
     * @var string
     */
    private $path = '/msun-middle-aggregate-zyemr/v1/m-records/mr-content-structs';
    /**
     * @var HttpClient
     */
    private $client;
    /**
     * @var array
     */
    private $required = ['patInHosId'];
    /**
     * @var string
     */
    private $hospitalId;

    /**
     * Dept constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->hospitalId = $config['hospitalId'] ?? '';
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
        $params['hospitalId'] = $this->hospitalId;
        return $this->toArray($this->client->get($this->path, $params));
    }


}