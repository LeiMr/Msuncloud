<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\Medical;

use GuzzleHttp\Exception\GuzzleException;
use StarLei\Msuncloud\HttpClient;
use StarLei\Msuncloud\Kernel\Exceptions\Exception;
use StarLei\Msuncloud\Kernel\Exceptions\HttpException;
use StarLei\Msuncloud\Kernel\Exceptions\InvalidConfigException;
use StarLei\Msuncloud\Kernel\Traits\BusinessResponse;

/**
 *  2.4.1.5. 批量查询执行医嘱
 * Class BatchOrder
 * @package StarLei\Msuncloud\CareCloud
 */
class BatchOrder
{
    use BusinessResponse;

    /**
     * @var string
     */
    private $path = '/msun-middle-aggregate-clinic/v1/out-exe-orders';
    /**
     * @var HttpClient
     */
    private $client;
    /**
     * @var array
     */
    private $required = ['startTime','endTime','patId'];

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
        if (count($requiredArr) !== count($this->required)) {
            throw new Exception('缺少必要的参数');
        }
        return $this->toArray($this->client->get($this->path, $params));
    }


}