<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Wine;
use App\Models\WinerySetting;

class WinerySettingPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === UserRole::WINERY;
    }

    public function view(User $user, WinerySetting $winerySetting): bool
    {
        return $user->role === UserRole::WINERY && $user->id === $winerySetting->winery->user_id;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, WinerySetting $winerySetting): bool
    {
        return $user->role === UserRole::WINERY && $user->id === $winerySetting->winery->user_id;
    }

    public function delete(User $user, Wine $wine): bool
    {
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }

    public function restore(User $user, Wine $wine): bool
    {
        return false;
    }

    public function forceDelete(User $user, Wine $wine): bool
    {
        return false;
    }
}
