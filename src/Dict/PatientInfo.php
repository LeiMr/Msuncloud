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
 * 2.1.33. 根据身份证查询患者
 * Class PatientInfo
 * @package StarLei\Msuncloud\Dict
 */
class PatientInfo
{
    use BusinessResponse;

    /**
     * @var string
     */
    private $path = '/msun-middle-aggregate-patient/v1/pat-infos/{orgId}/v2';
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
     * @param int $orgId
     * @param array $params
     * @return array
     * @throws Exception
     * @throws GuzzleException
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function index(int $orgId, array $params = []): array
    {
        $replacements = [
            'orgId' => $orgId
        ];
        $path = customReplace($this->path, $replacements);
        return $this->toArray($this->client->post($path, $params));
    }


}