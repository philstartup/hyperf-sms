<?php

declare(strict_types=1);

namespace HyperfLjh\Sms\Exceptions;

use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Throwable;

class DriverErrorException extends RuntimeException
{
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    public $response;

    public function __construct(
        string $message,
        $code = null,
        ResponseInterface $response = null,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->response = $response;
    }

    final public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
