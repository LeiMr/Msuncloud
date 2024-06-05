<?php
declare(strict_types=1);
namespace StarLei\Msuncloud\Kernel\Traits;


use Psr\Http\Message\ResponseInterface;
use StarLei\Msuncloud\Kernel\Contracts\Arrayable;
use StarLei\Msuncloud\Kernel\Exceptions\InvalidConfigException;
use StarLei\Msuncloud\Kernel\Http\Response;

/**
 * Trait ResponseCastable
 * @package StarLei\Msuncloud\Kernel\Traits
 */
trait ResponseCastable
{
    /**
     * @param ResponseInterface $response
     * @param string $type
     * @return array|mixed|object|Response
     * @throws InvalidConfigException
     */
    protected function castResponseToType(ResponseInterface $response, $type = 'array')
    {
        $response = Response::buildFromPsrResponse($response);
        $response->getBody()->rewind();

        switch ($type ?? 'array') {
            case 'array':
                return $response->toArray();
            case 'json':
                return $response->toJson();
            case 'object':
                return $response->toObject();
            case 'raw':
                return $response;
            default:
                if (!is_subclass_of($type, Arrayable::class)) {
                    throw new InvalidConfigException(sprintf('Config key "response_type" classname must be an instanceof %s', Arrayable::class));
                }

                return new $type($response);
        }
    }
}
