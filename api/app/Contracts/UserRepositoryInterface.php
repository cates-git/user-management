<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function list(): Collection;

    public function store(array $user): User;

    public function update(User $user, array $details): int;

    public function delete(User $user): void;
}