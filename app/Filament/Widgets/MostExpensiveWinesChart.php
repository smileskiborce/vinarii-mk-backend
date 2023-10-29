<?php

namespace App\Filament\Widgets;

use App\Enums\UserRole;
use App\Models\Wine;
use Filament\Widgets\ChartWidget;

class MostExpensiveWinesChart extends ChartWidget
{
    protected static ?string $heading = 'My most expensive wines';

    protected int|string|array $columnSpan = 2;

    public static function canView(): bool
    {
        return auth()->user()->role === UserRole::WINERY;
    }

    protected function getData(): array
    {
        $mostExpensiveWines = Wine::query()
            ->whereHas('winery', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->orderByDesc('price')
            ->take(5)
            ->get();

        $labels = [];
        $prices = [];

        foreach ($mostExpensiveWines as $wine) {
            $labels[] = $wine->name;
            $prices[] = $wine->price;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Wine Price',
                    'data' => $prices,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
