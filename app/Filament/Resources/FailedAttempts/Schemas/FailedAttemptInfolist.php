<?php

namespace App\Filament\Resources\FailedAttempts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FailedAttemptInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('student_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('lecture_session_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('reason')
                    ->badge(),
                TextEntry::make('ip_address')
                    ->placeholder('-'),
                TextEntry::make('description')
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
