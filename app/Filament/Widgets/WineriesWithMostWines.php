<?php

namespace App\Filament\Widgets;

use App\Enums\UserRole;
use App\Models\Winery;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class WineriesWithMostWines extends BaseWidget
{
    public static function canView(): bool
    {
        return auth()->user()->role === UserRole::ADMIN;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Winery::select('wineries.*', DB::raw('(SELECT COUNT(*) FROM wines WHERE wines.winery_id = wineries.id) as wine_count'))
                    ->orderByDesc('wine_count')
                    ->take(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('legal_name'),
                Tables\Columns\TextColumn::make('wine_count')
                    ->label('Number of wines'),
            ])
            ->paginated(false);
    }
}
