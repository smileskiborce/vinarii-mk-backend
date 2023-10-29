<?php

namespace App\Filament\Widgets;

use App\Enums\UserRole;
use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class UsersWithMostWineries extends BaseWidget
{
    public static function canView(): bool
    {
        return auth()->user()->role === UserRole::ADMIN;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::select('users.*', DB::raw('(SELECT COUNT(*) FROM wineries WHERE wineries.user_id = users.id) as winery_count'))
                    ->orderByDesc('winery_count')
                    ->take(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('winery_count')
                    ->label('Number of wineries'),
            ])
            ->paginated(false);
    }
}
