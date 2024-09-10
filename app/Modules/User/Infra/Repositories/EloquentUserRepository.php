<?php

namespace App\Modules\User\Infra\Repositories;

use App\Modules\User\Application\Dto\Create\CreateUserInputDto;
use App\Modules\User\Application\Dto\Update\UpdateUserInputDto;
use App\Modules\User\Domain\Entities\User;
use App\Modules\User\Domain\Repositories\UserRepository;

class EloquentUserRepository implements UserRepository
{
    public function create(CreateUserInputDto $inputDto): User
    {
        $user = new User();
        $user->name = $inputDto->name;
        $user->email = $inputDto->email;
        $user->password = $inputDto->password;
        $user->role = $inputDto->role;
        $user->save();

        return $user;
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function update(int $id, UpdateUserInputDto $inputDto): User
    {
        $user = User::find($id);
        $user->name = $inputDto->name;
        $user->email = $inputDto->email;
        $user->role = $inputDto->role;
        $user->save();

        return $user;
    }

    public function delete(int $id): bool
    {
        return User::destroy($id) > 0;
    }

    public function save(User $user): User
    {
        $user->save();
        return $user;
    }

    public function findAll(): array
    {
        return User::all()->toArray();
    }
}