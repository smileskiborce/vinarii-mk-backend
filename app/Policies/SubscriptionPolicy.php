<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;

class SubscriptionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === UserRole::ADMIN;
    }

    public function view(User $user): bool
    {
        return $user->role === UserRole::ADMIN;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user): bool
    {
        return false;
    }

    public function delete(User $user): bool
    {
        return $user->role === UserRole::ADMIN;
    }

    public function deleteAny(User $user): bool
    {
        return $user->role === UserRole::ADMIN;
    }

    public function restore(User $user): bool
    {
        return $user->role === UserRole::ADMIN;
    }

    public function forceDelete(User $user): bool
    {
        return false;
    }
}
