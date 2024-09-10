<?php

namespace App\Modules\User\Domain\Services;

use App\Modules\User\Application\Dto\Create\CreateUserInputDto;
use App\Modules\User\Domain\Entities\User;
use App\Modules\User\Domain\Repositories\UserRepository;

class UserService
{
    private UserRepository $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(CreateUserInputDto $inputDto): User
    {
        return $this->userRepository->create($inputDto);
    }
}