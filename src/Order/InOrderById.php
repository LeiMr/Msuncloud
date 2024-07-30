<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\Order;

use GuzzleHttp\Exception\GuzzleException;
use StarLei\Msuncloud\HttpClient;
use StarLei\Msuncloud\Kernel\Exceptions\Exception;
use StarLei\Msuncloud\Kernel\Exceptions\HttpException;
use StarLei\Msuncloud\Kernel\Exceptions\InvalidConfigException;
use StarLei\Msuncloud\Kernel\Traits\BusinessResponse;

/**
 *  2.3.9. 医嘱批量查询
 * Class ChangeDept
 * @package StarLei\Msuncloud\CareCloud
 */
class InOrderById
{
    use BusinessResponse;

    /**
     * @var string
     */
    private $path = '/msun-middle-aggregate-zyemr/v1/in-orders/getByParam';
    /**
     * @var HttpClient
     */
    private $client;
    /**
     * @var array
     */
    private $required = ['orderMainIdList'];

    /**
     * Dept constructor.
     * @param $config
     * @throws GuzzleException
     * @throws InvalidConfigException
     */
    public function __construct($config)
    {
        $this->client = new HttpClient($config);
    }

    /**
     * @param array $params
     * @return array
     * @throws Exception
     * @throws GuzzleException
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function index(array $params = []): array
    {
        $requiredArr = only($params, $this->required);
        if (empty($requiredArr)) {
            throw new Exception('缺少必要的参数');
        }
        return $this->toArray($this->client->post($this->path, $params));
    }


}