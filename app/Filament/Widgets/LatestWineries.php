<?php

namespace App\Filament\Widgets;

use App\Enums\UserRole;
use App\Models\Winery;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestWineries extends BaseWidget
{
    public static function canView(): bool
    {
        return auth()->user()->role === UserRole::ADMIN;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Winery::query()->latest()->take(5),
            )
            ->columns([
                Tables\Columns\TextColumn::make('legal_name'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Created from'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->paginated(false);
    }
}
