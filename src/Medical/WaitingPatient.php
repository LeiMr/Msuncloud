<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\Medical;

use GuzzleHttp\Exception\GuzzleException;
use StarLei\Msuncloud\Dict\LoginUser;
use StarLei\Msuncloud\HttpClient;
use StarLei\Msuncloud\Kernel\Exceptions\Exception;
use StarLei\Msuncloud\Kernel\Exceptions\HttpException;
use StarLei\Msuncloud\Kernel\Exceptions\InvalidConfigException;
use StarLei\Msuncloud\Kernel\Traits\BusinessResponse;

/**
 * 2.4.6.1. 获取有效门诊就诊记录
 * Class PatientInfo
 * @package StarLei\Msuncloud\Medical
 */
class WaitingPatient
{
    use BusinessResponse;

    /**
     * @var string
     */
    private $path = '/msun-his-app-mzemr/v1/out-emr-patrint';
    /**
     * @var HttpClient
     */
    private $client;
    /**
     * @var LoginUser
     */
    private $loginUserClient;

    /**
     * Dept constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->client = new HttpClient($config);
        $this->loginUserClient = new LoginUser($config);
    }

    /**
     * @param array $params
     * @param string|int|null $userId
     * @return array
     * @throws Exception
     * @throws GuzzleException
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function index($params = [], $userId = null): array
    {
        if ($userId) {
            $loginUser = $this->loginUserClient->index($userId);
            if (empty($loginUser)) {
                throw new Exception('获取用户登录信息失败');
            }
            $this->client->setHeaderLoginUser($loginUser);
        }
        return $this->toArray($this->client->post($this->path, $params));
    }


}