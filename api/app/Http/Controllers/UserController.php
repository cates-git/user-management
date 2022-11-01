<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->userService->list());
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = $this->userService->store($request->all());
        return response()->json($user);
    }

    public function update(User $user, UpdateUserRequest $request): JsonResponse
    {
        $user = $this->userService->update($user, $request->all());
        return response()->json($user);
    }

    public function delete(User $user): JsonResponse
    {
        $user = $this->userService->delete($user);
        return response()->json($user);
    }
}
