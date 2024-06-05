<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\Dict;

use StarLei\Msuncloud\Kernel\Exceptions\Exception;
use Throwable;

class LoginUser
{
    /**
     * @var User
     */
    private $userClient;
    /**
     * @var Identity
     */
    private $identityClient;
    /**
     * @var Dept
     */
    private $deptClient;

    /**
     * @var array
     */
    private $config;

    /**
     * Dept constructor.
     * @param $config
     */
    public function __construct(array $config)
    {
        $this->userClient = new User($config);
        $this->identityClient = new Identity($config);
    }

    /**
     * 根据用户id获取接口所需loginUser对象base64
     * @param $userId
     * @return string
     */
    public function index($userId): string
    {
        try {
            //.获取用户信息
            $userInfo = $this->userClient->index(['userId' => $userId]);
            if (!isset($userInfo[0])) {
                throw new Exception('获取用户信息失败');
            }
            $identityInfo = $this->identityClient->index(['userId' => $userId, 'deptId' => $userInfo[0]['deptId']]);
            if (!isset($identityInfo[0])) {
                throw new Exception('获取用户身份信息失败');
            }
            $loginUser = [
                'userSysId' => $identityInfo[0]['identityId'],
                'userId' => $userId,
                'userName' => $userInfo[0]['userName'],
                'hospitalId' => $userInfo[0]['hospitalId'],
                'hospitalName' => $userInfo[0]['hospitalId'],
                'orgId' => $userInfo[0]['orgId'],
                'deptId' => $userInfo[0]['deptId'],
                'deptName' => $userInfo[0]['deptName'],
                'deptCode' => $userInfo[0]['deptCode']
            ];
            return base64_encode(json_encode($loginUser, JSON_UNESCAPED_UNICODE));
        } catch (Throwable $e) {
            var_dump($e->getMessage());
            return '';
        }
    }
}