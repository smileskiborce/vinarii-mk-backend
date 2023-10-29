<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Wine;

class WinePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === UserRole::WINERY;
    }

    public function view(User $user, Wine $wine): bool
    {
        return $user->role === UserRole::WINERY && $user->id === $wine->user_id;
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::WINERY;
    }

    public function update(User $user, Wine $wine): bool
    {
        return $user->role === UserRole::WINERY && $user->id === $wine->winery->user_id;
    }

    public function delete(User $user, Wine $wine): bool
    {
        return $user->role === UserRole::WINERY && $user->id === $wine->winery->user_id;
    }

    public function deleteAny(User $user): bool
    {
        return $user->role === UserRole::WINERY;
    }

    public function restore(User $user, Wine $wine): bool
    {
        return $user->role === UserRole::WINERY && $user->id === $wine->user_id;
    }

    public function forceDelete(User $user, Wine $wine): bool
    {
        return $user->role === UserRole::WINERY && $user->id === $wine->user_id;
    }
}
