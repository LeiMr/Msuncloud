<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\Kernel\Contracts;


/**
 * Interface RequestInterface
 * @package StarLei\Msuncloud\Kernel\Contracts
 */
interface RequestInterface
{

    public function setAppSecret(string $appSecret): self;

    public function setHeader(array $params = []): self;

    public function setParams(array $params = []): self;

    public function setBaseUri(string $baseUri): self;

    public function request(string $url, string $method = 'GET', array $options = [], $debug = false, $returnType = 'array');

    public function generation(string $path = '', array $params = [], string $method = 'GET'): array;

}
