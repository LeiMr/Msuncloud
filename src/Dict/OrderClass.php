<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\Dict;

use GuzzleHttp\Exception\GuzzleException;
use StarLei\Msuncloud\HttpClient;
use StarLei\Msuncloud\Kernel\Exceptions\Exception;
use StarLei\Msuncloud\Kernel\Exceptions\HttpException;
use StarLei\Msuncloud\Kernel\Exceptions\InvalidConfigException;
use StarLei\Msuncloud\Kernel\Traits\BusinessResponse;

/**
 * 2.1.28. 查询医嘱类别
 * Class OrderClass
 * @package StarLei\Msuncloud\Dict
 */
class OrderClass
{
    use BusinessResponse;

    /**
     * @var string
     */
    private $path = '/msun-middle-base-common/v1/dict-order-class';
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
     * @param $params
     * @return array
     * @throws GuzzleException
     * @throws HttpException
     * @throws InvalidConfigException|Exception
     */
    public function index($params = []): array
    {
        return $this->toArray($this->client->get($this->path, $params));
    }


}