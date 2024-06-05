<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\Diagnosis;

use GuzzleHttp\Exception\GuzzleException;
use StarLei\Msuncloud\HttpClient;
use StarLei\Msuncloud\Kernel\Exceptions\Exception;
use StarLei\Msuncloud\Kernel\Exceptions\HttpException;
use StarLei\Msuncloud\Kernel\Exceptions\InvalidConfigException;
use StarLei\Msuncloud\Kernel\Traits\BusinessResponse;

/**
 * 2.39.5. 会诊记录查询
 * Class FindPatAllDiagnosis
 * @package StarLei\Msuncloud\Diagnosis
 */
class FindPatAllDiagnosis
{
    use BusinessResponse;

    /**
     * @var string
     */
    private $path = '/msun-middle-aggregate-zyemr/v1/findPatAllDiagnosis';
    /**
     * @var HttpClient
     */
    private $client;
    /**
     * @var array
     */
    private $required = ['patInHosIdList'];

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
        if (empty($requiredArr)) {
            throw new Exception('缺少必要的参数');
        }
        $params['patInHosIdList'] = implode(',', $params['patInHosIdList']);
        return $this->toArray($this->client->get($this->path, $params));
    }


}