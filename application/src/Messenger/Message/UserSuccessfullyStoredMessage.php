<?php

declare(strict_types=1);

namespace App\Messenger\Message;

class UserSuccessfullyStoredMessage
{
    private string $name;
    private string $email;
    private string $code;

    public function __construct(string $name, string $email, string $code)
    {
        $this->name = $name;
        $this->email = $email;
        $this->code = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
