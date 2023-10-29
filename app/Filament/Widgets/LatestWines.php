<?php

namespace App\Filament\Widgets;

use App\Enums\UserRole;
use App\Models\Wine;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestWines extends BaseWidget
{
    public static function canView(): bool
    {
        return auth()->user()->role === UserRole::ADMIN;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Wine::query()->latest()->take(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('winery.legal_name')
                    ->label('Created from winery'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->paginated(false);
    }
}
