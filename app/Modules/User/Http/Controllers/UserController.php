<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Application\Dto\Create\CreateUserInputDto;
use App\Modules\User\Application\UseCases\CreateUserUseCase;
use App\Modules\User\Domain\Entities\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private CreateUserUseCase $createUserUseCase;

    public function __construct(CreateUserUseCase $createUserUseCase) {
        $this->createUserUseCase = $createUserUseCase;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::where('role', '=', 'doctor')->get();

            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => 'required|string|min:8',
                'role' => 'required|string'
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);

            $inputDto = new CreateUserInputDto(
                $validatedData['name'],
                $validatedData['email'],
                $validatedData['password'],
                $validatedData['role']
            );

            $user = $this->createUserUseCase->execute($inputDto);

            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
