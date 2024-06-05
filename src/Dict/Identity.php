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
 * 2.1.12. 用户身份信息接口
 * Class Identity
 * @package StarLei\Msuncloud\Dict
 */
class Identity
{
    use BusinessResponse;

    /**
     * @var string
     */
    private $path = '/msun-middle-base-common/v1/identities';
    /**
     * @var HttpClient
     */
    private $client;
    /**
     * @var array
     */
    private $required = ['roleType', 'deptId', 'identityId', 'userId'];

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
        $params = only($params, $this->required);
        if (empty($params)) {
            throw new Exception('缺少必要的参数');
        }
        return $this->toArray($this->client->get($this->path, $params));
    }


}