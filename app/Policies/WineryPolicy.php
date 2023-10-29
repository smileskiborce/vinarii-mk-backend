<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Winery;

class WineryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === UserRole::WINERY;
    }

    public function view(User $user, Winery $winery): bool
    {
        return $user->role === UserRole::WINERY && $user->wineries->contains('id', $winery->id);
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::WINERY;
    }

    public function update(User $user, Winery $winery): bool
    {
        return $user->role === UserRole::WINERY && $user->wineries->contains('id', $winery->id);
    }

    public function delete(User $user, Winery $winery): bool
    {
        return $user->role === UserRole::WINERY && $user->wineries->contains('id', $winery->id);
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }

    public function restore(User $user): bool
    {
        return false;
    }

    public function forceDelete(User $user): bool
    {
        return false;
    }
}
