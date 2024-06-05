<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\Order;

use GuzzleHttp\Exception\GuzzleException;
use StarLei\Msuncloud\Dict\LoginUser;
use StarLei\Msuncloud\HttpClient;
use StarLei\Msuncloud\Kernel\Exceptions\Exception;
use StarLei\Msuncloud\Kernel\Exceptions\HttpException;
use StarLei\Msuncloud\Kernel\Exceptions\InvalidConfigException;
use StarLei\Msuncloud\Kernel\Traits\BusinessResponse;

/**
 *  2.3.6. 查询医嘱
 * Class ChangeDept
 * @package StarLei\Msuncloud\CareCloud
 */
class InOrder
{
    use BusinessResponse;

    /**
     * @var string
     */
    private $path = '/msun-middle-aggregate-zyemr/v1/in-orders';
    /**
     * @var HttpClient
     */
    private $client;
    /**
     * Dept constructor.
     * @param $config
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
    public function index($params = []): array
    {
        return $this->toArray($this->client->get($this->path, $params));
    }


}