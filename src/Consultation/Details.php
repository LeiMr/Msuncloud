<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\Consultation;

use GuzzleHttp\Exception\GuzzleException;
use StarLei\Msuncloud\HttpClient;
use StarLei\Msuncloud\Kernel\Exceptions\Exception;
use StarLei\Msuncloud\Kernel\Exceptions\HttpException;
use StarLei\Msuncloud\Kernel\Exceptions\InvalidConfigException;
use StarLei\Msuncloud\Kernel\Traits\BusinessResponse;

/**
 * 2.39.2. 根据会诊申请单id查询会诊详情
 * Class PatientInfo
 * @package StarLei\Msuncloud\Consultation
 */
class Details
{
    use BusinessResponse;

    /**
     * @var string
     */
    private $path = '/msun-areahealth-app-ygt/v1/rmc/rmc-details/{rmcId}';
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
     * @param int $rmcId
     * @return array
     * @throws Exception
     * @throws GuzzleException
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function index(int $rmcId): array
    {
        $replacements = [
            'rmcId' => $rmcId
        ];
        $path = customReplace($this->path, $replacements);
        return $this->toArray($this->client->get($path));
    }


}