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
 * 2.7.4. 报告单详情接口
 * Class Details
 * @package StarLei\Msuncloud\Lis
 */
class Details
{
    use BusinessResponse;

    /**
     * @var string
     */
    private $path = '/msun-middle-business-lis/v1/lis-reports/details';
    /**
     * @var HttpClient
     */
    private $client;
    /**
     * @var array
     */
    private $required = ['reportId'];

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