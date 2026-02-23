<?php

namespace App\Filament\Resources\AuditLogs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AuditLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('user_type')
                    ->default(null),
                TextInput::make('action')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('ip_address')
                    ->default(null),
                TextInput::make('location')
                    ->default(null),
                Select::make('severity')
                    ->options(['info' => 'Info', 'warning' => 'Warning', 'error' => 'Error', 'critical' => 'Critical'])
                    ->default('info')
                    ->required(),
                Textarea::make('metadata')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
