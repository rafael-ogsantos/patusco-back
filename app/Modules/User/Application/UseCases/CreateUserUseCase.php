<?php

namespace App\Modules\User\Application\UseCases;

use App\Modules\User\Application\Dto\Create\CreateUserInputDto;
use App\Modules\User\Application\Dto\Create\CreateUserOutputDto;
use App\Modules\User\Domain\Services\UserService;

class CreateUserUseCase
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function execute(CreateUserInputDto $inputDto): CreateUserOutputDto
    {
        $user = $this->userService->create($inputDto);

        return new CreateUserOutputDto(
            $user->name,
            $user->email,
            $user->password,
            $user->role,
            $user->updated_at,
            $user->created_at
        );
    }
}