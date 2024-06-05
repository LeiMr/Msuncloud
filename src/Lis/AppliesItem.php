<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\Lis;

use GuzzleHttp\Exception\GuzzleException;
use StarLei\Msuncloud\HttpClient;
use StarLei\Msuncloud\Kernel\Exceptions\Exception;
use StarLei\Msuncloud\Kernel\Exceptions\HttpException;
use StarLei\Msuncloud\Kernel\Exceptions\InvalidConfigException;
use StarLei\Msuncloud\Kernel\Traits\BusinessResponse;

/**
 * 22.7.10. LIS检验项目查询
 * Class Details
 * @package StarLei\Msuncloud\Lis
 */
class AppliesItem
{
    use BusinessResponse;

    /**
     * @var string
     */
    private $path = '/msun-middle-business-lis/v1/lis-applies/items';
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