<?php

declare(strict_types=1);

namespace App\Service;

use App\Http\Client\Exception\Http\HttpClientException;
use App\Http\Client\HttpClientInterface;
use App\Messenger\Message\UserRegisteredMessage;
use App\Messenger\RoutingKey;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;

class RegisterActionService
{
    private MessageBusInterface $bus;

    private HttpClientInterface $httpClient;

    private string $applicationServiceUsersEndpoint;

    public function __construct(MessageBusInterface $bus, HttpClientInterface $httpClient, string $applicationServiceUsersEndpoint)
    {
        $this->bus = $bus;
        $this->httpClient = $httpClient;
        $this->applicationServiceUsersEndpoint = $applicationServiceUsersEndpoint;
    }

    public function __invoke(string $name, string $email): void
    {
        try {
            $this->httpClient->get(\sprintf('%s?email=%s', $this->applicationServiceUsersEndpoint, $email));
        } catch (HttpClientException $e) {
            if (JsonResponse::HTTP_NOT_FOUND === $e->getStatusCode()) {
                $this->bus->dispatch(
                    new UserRegisteredMessage($name, $email),
                    [new AmqpStamp(RoutingKey::REGISTER_APPLICATION_QUEUE)]
                );
            }

            return;
        }

        throw new ConflictHttpException(\sprintf('User with email %s already exists', $email));
    }
}
