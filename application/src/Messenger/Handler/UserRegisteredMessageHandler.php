<?php

declare(strict_types=1);

namespace App\Messenger\Handler;

use App\Entity\User;
use App\Messenger\Message\UserRegisteredMessage;
use App\Repository\UserRepository;
use Symfony\Component\Messenger\Exception\UnrecoverableMessageHandlingException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UserRegisteredMessageHandler implements MessageHandlerInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UserRegisteredMessage $message): void
    {
        $user = new User($message->getName(), $message->getEmail());

        try {
            $this->userRepository->save($user);
        } catch (\Exception $e) {
            throw new UnrecoverableMessageHandlingException(\sprintf('User with email %s already exists', $message->getEmail()));
        }
    }
}
