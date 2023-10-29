<?php

namespace App\Filament\Resources\WineryResource\Pages;

use App\Filament\Resources\WineryResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\ManageRecords;

class ManageWineries extends ManageRecords
{
    protected static string $resource = WineryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->steps([
                    Step::make('Default Information')
                        ->description('Default information about the winery')
                        ->schema([
                            TextInput::make('legal_name')
                                ->required()
                                ->maxLength(255),
                            FileUpload::make('logo_image')
                                ->image(),
                            FileUpload::make('cover_image')
                                ->image(),
                        ]),
                    Step::make('Additional Information')
                        ->description('Additional information about the winery')
                        ->schema([
                            TextInput::make('address')
                                ->maxLength(255),
                            TextInput::make('email')
                                ->email()
                                ->maxLength(255),
                            TextInput::make('phone')
                                ->tel()
                                ->maxLength(255),
                            TextInput::make('description')
                                ->maxLength(255),
                            TextInput::make('working_hours')
                                ->maxLength(255),
                        ]),
                ]),
        ];
    }
}
