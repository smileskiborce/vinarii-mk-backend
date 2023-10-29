<?php

namespace App\Filament\Resources\WineResource\Pages;

use App\Filament\Resources\WineResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageWines extends ManageRecords
{
    protected static string $resource = WineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
