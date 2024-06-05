<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\CareCloud;

use GuzzleHttp\Exception\GuzzleException;
use StarLei\Msuncloud\Dict\LoginUser;
use StarLei\Msuncloud\HttpClient;
use StarLei\Msuncloud\Kernel\Exceptions\Exception;
use StarLei\Msuncloud\Kernel\Exceptions\HttpException;
use StarLei\Msuncloud\Kernel\Exceptions\InvalidConfigException;
use StarLei\Msuncloud\Kernel\Traits\BusinessResponse;

/**
 *  2.2.2. 患者转科记录信息查询
 * Class ChangeDept
 * @package StarLei\Msuncloud\CareCloud
 */
class ChangeDept
{
    use BusinessResponse;

    /**
     * @var string
     */
    private $path = '/msun-middle-aggregate-hsz/v1/change-depts';
    /**
     * @var HttpClient
     */
    private $client;
    /**
     * @var array
     */
    private $required = ['patInHosIds'];
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
     * @param null $userId
     * @return array
     * @throws Exception
     * @throws GuzzleException
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function index($params = [], $userId = null): array
    {
        $requiredArr = only($params, $this->required);
        if (empty($requiredArr)) {
            throw new Exception('缺少必要的参数');
        }
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