<?php

declare(strict_types=1);

namespace App\Http\Client\Exception\Http;

use Symfony\Component\HttpKernel\Exception\HttpException;

class HttpClientException extends HttpException
{
    public function __construct(int $statusCode, string $message)
    {
        parent::__construct($statusCode, $message);
    }
}
