<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class User
{
    private string $id;
    private string $name;
    private string $email;
    private ?string $password;
    private ?string $code;
    private \DateTime $createdOn;

    public function __construct(string $name, string $email, string $code)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->email = $email;
        $this->password = null;
        $this->code = $code;
        $this->createdOn = new \DateTime();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getCreatedOn(): \DateTime
    {
        return $this->createdOn;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'createdOn' => $this->createdOn->format(\DateTime::RFC3339),
        ];
    }
}
