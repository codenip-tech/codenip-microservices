<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

class FindUserByEmailActionService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(string $email): ?User
    {
        return $this->userRepository->findOneBy(['email' => $email]);
    }
}
