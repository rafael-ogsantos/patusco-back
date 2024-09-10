<?php

namespace App\Modules\User\Application\Dto\Create;

class CreateUserOutputDto
{
    public string $id;
    public string $name;
    public string $email;
    public string $role;
    public string $updated_at;
    public string $created_at;

    public function __construct(
        string $id,
        string $name,
        string $email,
        string $role,
        string $updated_at,
        string $created_at
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->updated_at = $updated_at;
        $this->created_at = $created_at;
    }
}