<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\Kernel\Http;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Psr\Http\Message\ResponseInterface;
use function mb_convert_encoding;
use function preg_replace;

/**
 * Class Response.
 *
 * @author overtrue <i@overtrue.me>
 */
class Response extends GuzzleResponse
{
    /**
     * @param ResponseInterface $response
     *
     * @return Response
     */
    public static function buildFromPsrResponse(ResponseInterface $response): Response
    {
        return new static(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getProtocolVersion(),
            $response->getReasonPhrase()
        );
    }

    /**
     * @return object
     */
    public function toObject()
    {
        return json_decode($this->toJson());
    }

    /**
     * Build to json.
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * Build to array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $content = $this->removeControlCharacters($this->getBodyContents());
        $array = json_decode($content, true, 512, JSON_BIGINT_AS_STRING);

        if (JSON_ERROR_NONE === json_last_error()) {
            return (array)$array;
        }

        return [];
    }

    /**
     * @param string $content
     *
     * @return string
     */
    protected function removeControlCharacters(string $content): string
    {
        return preg_replace('/[\x00-\x1F\x80-\x9F]/u', '', mb_convert_encoding($content, 'UTF-8', 'UTF-8'));
    }

    /**
     * @return string
     */
    public function getBodyContents(): string
    {
        $this->getBody()->rewind();
        $contents = $this->getBody()->getContents();
        $this->getBody()->rewind();

        return $contents;
    }

    /**
     * @return bool|string
     */
    public function __toString()
    {
        return $this->getBodyContents();
    }
}
