<?php

namespace App\Filament\Resources\Halls\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HallInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('code'),
                TextEntry::make('name'),
                TextEntry::make('floor')
                    ->numeric(),
                TextEntry::make('capacity')
                    ->numeric(),
                IconEntry::make('has_projector')
                    ->boolean(),
                IconEntry::make('has_computer')
                    ->boolean(),
                TextEntry::make('network_ssid')
                    ->placeholder('-'),
                TextEntry::make('ip_range_start')
                    ->placeholder('-'),
                TextEntry::make('ip_range_end')
                    ->placeholder('-'),
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
