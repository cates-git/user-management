<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function list(): Collection
    {
        return $this->user->all();
    }

    public function store(array $user): User
    {
        return $this->user->create($user);
    }

    public function update(User $user, array $details): int
    {
        return $user->update($details);
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
