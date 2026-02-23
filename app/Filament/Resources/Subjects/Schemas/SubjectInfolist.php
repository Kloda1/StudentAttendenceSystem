<?php

namespace App\Filament\Resources\Subjects\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SubjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('code'),
                TextEntry::make('name'),
                TextEntry::make('lecturer_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('department_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('credit_hours')
                    ->numeric(),
                TextEntry::make('level')
                    ->numeric(),
                TextEntry::make('semester')
                    ->numeric(),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
