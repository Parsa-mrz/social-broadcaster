<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function findById ( int $id ): ?User
    {
        return User::find($id);
    }

    public function findByEmail ( string $email ): ?User
    {
        return User::where('email', $email)->first();
    }

    public function getAll (): Collection
    {
        return User::all();
    }

    public function createUser ( array $data ): User
    {
        return User::create($data);
    }
}
