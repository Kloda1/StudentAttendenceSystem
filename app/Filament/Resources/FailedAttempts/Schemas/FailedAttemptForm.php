<?php

namespace App\Filament\Resources\FailedAttempts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FailedAttemptForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('student_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('lecture_session_id')
                    ->numeric()
                    ->default(null),
                Select::make('reason')
                    ->options([
            'wrong_otp' => 'Wrong otp',
            'wrong_ip' => 'Wrong ip',
            'device_blocked' => 'Device blocked',
            'duplicate_device' => 'Duplicate device',
            'late' => 'Late',
            'other' => 'Other',
        ])
                    ->default('other')
                    ->required(),
                TextInput::make('ip_address')
                    ->default(null),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
