<?php

namespace App\Filament\Resources\Subjects\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SubjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('lecturer_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('department_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('credit_hours')
                    ->required()
                    ->numeric(),
                TextInput::make('level')
                    ->required()
                    ->numeric(),
                TextInput::make('semester')
                    ->required()
                    ->numeric(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
