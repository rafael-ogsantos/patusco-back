<?php

namespace App\Modules\User\Domain\Repositories;

use App\Modules\User\Application\Dto\Create\CreateUserInputDto;
use App\Modules\User\Application\Dto\Update\UpdateUserInputDto;
use App\Modules\User\Domain\Entities\User;

interface UserRepository
{
    public function create(CreateUserInputDto $inputDto): User;
    public function findById(int $id): ?User;
    public function update(int $id, UpdateUserInputDto $inputDto): User;
    public function delete(int $id): bool;
    public function save(User $appointment): User;
    public function findAll(): array;
}
