<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\Kernel;

use Closure;
use GuzzleHttp\Exception\GuzzleException;
use StarLei\Msuncloud\Kernel\Contracts\RequestInterface;
use StarLei\Msuncloud\Kernel\Exceptions\HttpException;
use StarLei\Msuncloud\Kernel\Http\Response;
use StarLei\Msuncloud\Kernel\Traits\HasHttpRequests;

/**
 * @method BaseClient setHeaderOrgId($value)
 * @method BaseClient setHeaderHospitalId($value)
 * @method BaseClient setHeaderTimestamp($value)
 * @method BaseClient setHeaderSignType($value)
 * @method BaseClient setHeaderSign($value)
 * @method BaseClient setHeaderLoginUser($value)
 * @method BaseClient setHeaderGrayscale($value)
 */
class BaseClient implements RequestInterface
{
    use HasHttpRequests {
        request as performRequest;
    }

    /**
     * @var string
     */
    private $baseUri = 'https://thirdpart-graytest.msunhis.com:9443';
    /**
     * @var string
     */
    private $socketUrl = 'wss://thirdpart-graytest.msunhis.com:9443/openapi-websocket/msun-websocket-server/ws-server';
    /**
     * The paths that should be published.
     *
     * @var array
     */
    private $allowedHeader = ['orgId', 'hospitalId', 'appId', 'sign', 'timestamp', 'signType', 'loginUser', 'grayscale'];
    /**
     * @var array
     */
    private $defaultConfig = ['signType' => 'RSA2', 'grayscale' => true];
    /**
     * @var array
     */
    private $header = [];
    /**
     * @var string
     */
    private $appSecret;
    /**
     * @var array
     */
    private $data = [];
    /**
     * @var bool
     */
    private $debug = false;

    /**
     * SoapRequest constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->allocation($config);

    }

    /**
     * 配置处理
     * @param $config
     */
    protected function allocation($config)
    {
        $config = array_merge($this->defaultConfig, $config);

        if (isset($config['baseUri']) && !is_null($config['baseUri'])) {
            $this->setBaseUri($config['baseUri']);
        }
        if (isset($config['appSecret']) && !is_null($config['appSecret'])) {
            $this->setAppSecret($config['appSecret']);
        }
        $this->debug = $config['debug'] ?? false;
        $config = only($config, $this->allowedHeader);
        $this->setHeader($config);
        $this->setTime();

    }

    /**
     * 设置公共接口地址
     * @param string $baseUri
     * @return RequestInterface
     */
    public function setBaseUri(string $baseUri): RequestInterface
    {
        $this->baseUri = $baseUri;
        return $this;
    }

    /**
     * 设置AppSecret
     * @param string $appSecret
     * @return RequestInterface
     */
    public function setAppSecret(string $appSecret): RequestInterface
    {
        $this->appSecret = $appSecret;
        return $this;
    }

    /**
     * 设置数据的header部分
     * @param array $params
     * @return RequestInterface
     */
    public function setHeader(array $params = []): RequestInterface
    {
        $header = $this->header ? $this->header : [];
        $this->header = array_merge($header, $params);
        return $this;
    }

    /**
     * 设置当前时间戳
     * @return int
     */
    private function setTime(): int
    {
        $time = getTime();
        $this->setHeaderTimestamp($time);
        return $time;
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $options
     * @param false $returnRaw
     * @param string $returnType
     * @return array|mixed|object|Response
     * @throws Exceptions\InvalidConfigException
     * @throws GuzzleException
     */
    public function request(string $url, string $method = 'GET', array $options = [], $returnRaw = false, $returnType = 'array')
    {
        $response = $this->performRequest($url, $method, $options, $this->debug);
        return $returnRaw ? $response : $this->castResponseToType($response, $returnType);
    }

    /**
     *
     * 异步请求
     * @param array $options
     * @param Closure $success
     * @param Closure $error
     */
    public function asyncRequest(array $options,Closure $success, Closure $error)
    {
        $this->getHttpClientAsync($options,$success,$error,$this->debug);
    }

    /**
     * 获取对应模式的数据
     * @param string $path
     * @param array $params
     * @param string $method
     * @return array
     * @throws HttpException
     */
    public function generation(string $path = '', array $params = [], string $method = 'GET'): array
    {
        $url = $this->baseUri . $path;
        $this->setParams($params);
        switch ($method) {
            case 'POST':
                $signString = arrayToMD5String($this->data, $this->getTimestamp());
                $typeKey = 'json';
                break;
            case 'SOCKET':
                $signString = $this->getTimestamp();
                $typeKey = '';
                break;
            default:
                $string = arrayToQueryString($this->data);
                $signString = $string . $this->getTimestamp();
                $url .= '?' . $string;
                $typeKey = 'query';
        }
        $sign = getSign($signString, $this->appSecret);
        $this->setHeaderSign($sign);
        if ($method == 'SOCKET') {
            $url = $this->socketUrl . '?' . arrayToQueryString(array_merge($this->header, $this->data), true);
        }
        return [
            $url,
            [
                'headers' => $this->header,
                $typeKey => $this->data,
            ]
        ];
    }

    /**
     * 设置传输的参数
     * @param array $params
     * @return RequestInterface
     */
    public function setParams(array $params = []): RequestInterface
    {
        $data = $this->data ? $this->data : [];
        $this->data = array_merge($data, $params);
        return $this;
    }

    /**
     * 获取参数信息
     * @return int
     */
    private function getTimestamp(): int
    {
        return $this->header['timestamp'] ?? $this->setTime();
    }

    /**
     * 魔术方法
     * @param $method
     * @param $args
     * @return BaseClient
     * @throws HttpException
     */
    public function __call($method, $args): BaseClient
    {
        if (strpos($method, 'setHeader') === 0) {
            $propertyName = lcfirst(substr($method, strlen('setHeader')));
            if (in_array($propertyName, $this->allowedHeader)) {
                $this->header[$propertyName] = $args[0];
            } else {
                // 可以选择抛出异常或者执行其他逻辑
                throw new HttpException("Property '$propertyName' is not allowed.");
            }
        } else {
            // 如果调用了不存在的方法，可以选择抛出异常或者执行其他逻辑
            throw new HttpException("Method '$method' not found.");
        }
        return $this;
    }
}
