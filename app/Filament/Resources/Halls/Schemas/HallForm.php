<?php

namespace App\Filament\Resources\Halls\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HallForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('floor')
                    ->required()
                    ->numeric(),
                TextInput::make('capacity')
                    ->required()
                    ->numeric(),
                Toggle::make('has_projector')
                    ->required(),
                Toggle::make('has_computer')
                    ->required(),
                TextInput::make('network_ssid')
                    ->default(null),
                TextInput::make('ip_range_start')
                    ->default(null),
                TextInput::make('ip_range_end')
                    ->default(null),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
