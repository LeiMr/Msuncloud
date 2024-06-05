<?php
declare(strict_types=1);

namespace StarLei\Msuncloud\Kernel\Exceptions;

use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpException
 * @package StarLei\Msuncloud\Kernel\Exceptions
 */
class HttpException extends Exception
{
    /**
     * @var ResponseInterface|null
     */
    public $response;

    /**
     * @var ResponseInterface|array|object|string|null
     */
    public $formattedResponse;

    /**
     * HttpException constructor.
     *
     * @param string $message
     * @param ResponseInterface|null $response
     * @param null $formattedResponse
     * @param int|null $code
     */
    public function __construct(string $message, ResponseInterface $response = null, $formattedResponse = null, $code = 0)
    {
        parent::__construct($message, $code);

        $this->response = $response;
        $this->formattedResponse = $formattedResponse;

        if ($response) {
            $response->getBody()->rewind();
        }
    }
}
