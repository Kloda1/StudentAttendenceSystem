<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('lecture_session_id')
                    ->required()
                    ->numeric(),
                TextInput::make('student_id')
                    ->required()
                    ->numeric(),
                TextInput::make('attendance_token_id')
                    ->numeric()
                    ->default(null),
                DateTimePicker::make('attendance_time')
                    ->required(),
                Select::make('attendance_method')
                    ->options(['qr_scan' => 'Qr scan', 'manual' => 'Manual', 'admin' => 'Admin'])
                    ->default('qr_scan')
                    ->required(),
                Select::make('attendance_status')
                    ->options(['present' => 'Present', 'late' => 'Late', 'absent' => 'Absent', 'excused' => 'Excused'])
                    ->default('present')
                    ->required(),
                TextInput::make('ip_address')
                    ->default(null),
                TextInput::make('device_fingerprint')
                    ->default(null),
                Textarea::make('location_data')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
