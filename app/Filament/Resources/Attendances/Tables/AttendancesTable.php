<?php

namespace App\Filament\Resources\Attendances\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AttendancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lecture_session_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('student_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('attendance_token_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('attendance_time')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('attendance_method')
                    ->badge(),
                TextColumn::make('attendance_status')
                    ->badge(),
                TextColumn::make('ip_address')
                    ->searchable(),
                TextColumn::make('device_fingerprint')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
