<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class UserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function list(): Collection
    {
        return $this->userRepository->list();
    }

    public function store(array $data): User
    {
        return $this->userRepository->store([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => 'temp pass'
        ]);
    }

    public function update(User $user, array $data): int
    {
        $email = $data['email'];

        if (User::whereEmail($email)->where('id', '!=', $user->id)->first()) {
            throw ValidationException::withMessages(['email' => 'The email has already been taken.']);
        }

        return $this->userRepository->update($user, [
            'name'  => $data['name'],
            'email' => $data['email']
        ]);
    }

    public function delete(User $user): void
    {
        $this->userRepository->delete($user);
    }
}