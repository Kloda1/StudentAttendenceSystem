<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AttendanceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('lecture_session_id')
                    ->numeric(),
                TextEntry::make('student_id')
                    ->numeric(),
                TextEntry::make('attendance_token_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('attendance_time')
                    ->dateTime(),
                TextEntry::make('attendance_method')
                    ->badge(),
                TextEntry::make('attendance_status')
                    ->badge(),
                TextEntry::make('ip_address')
                    ->placeholder('-'),
                TextEntry::make('device_fingerprint')
                    ->placeholder('-'),
                TextEntry::make('location_data')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
