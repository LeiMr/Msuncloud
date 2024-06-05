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
 * 2.2.27. 住院患者执行医嘱信息查询（新版）
 * Class OrderReview
 * @package StarLei\Msuncloud\CareCloud
 */
class OrderReview
{
    use BusinessResponse;

    /**
     * @var string
     */
    private $path = '/msun-middle-aggregate-hsz/v2/to-be-review-in-nurseorders';
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
     * @param null $userId
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
        return $this->toArray($this->client->get($this->path, $params));
    }


}