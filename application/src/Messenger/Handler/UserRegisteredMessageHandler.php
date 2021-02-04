<?php

declare(strict_types=1);

namespace App\Messenger\Handler;

use App\Entity\User;
use App\Messenger\Message\UserRegisteredMessage;
use App\Messenger\Message\UserSuccessfullyStoredMessage;
use App\Messenger\RoutingKey;
use App\Repository\UserRepository;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\Exception\UnrecoverableMessageHandlingException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class UserRegisteredMessageHandler implements MessageHandlerInterface
{
    private UserRepository $userRepository;

    private MessageBusInterface $bus;

    public function __construct(UserRepository $userRepository, MessageBusInterface $bus)
    {
        $this->userRepository = $userRepository;
        $this->bus = $bus;
    }

    public function __invoke(UserRegisteredMessage $message): void
    {
        $user = new User($message->getName(), $message->getEmail(), \sha1(\uniqid()));

        try {
            $this->userRepository->save($user);
            $this->bus->dispatch(
                new UserSuccessfullyStoredMessage($user->getName(), $user->getEmail(), $user->getCode()),
                [new AmqpStamp(RoutingKey::APPLICATION_MAILER_QUEUE)]
            );
        } catch (\Exception $e) {
            throw new UnrecoverableMessageHandlingException(\sprintf('User with email %s already exists', $message->getEmail()));
        }
    }
}
