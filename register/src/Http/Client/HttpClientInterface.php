<?php

declare(strict_types=1);

namespace App\Http\Client;


use Psr\Http\Message\ResponseInterface;

interface HttpClientInterface
{
    public function get(string $url, array $options = []): ResponseInterface;
}
