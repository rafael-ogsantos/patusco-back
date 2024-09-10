<?php

namespace App\Modules\User\Application\Dto\Create;

use App\Modules\User\Domain\Enums\UserRole;

class CreateUserInputDto
{
    public string $name;
    public string $email;
    public string $password;
    public string $role;

    public function __construct(
        string $name,
        string $email,
        string $password,
        string $role
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role
        ];
    }
}