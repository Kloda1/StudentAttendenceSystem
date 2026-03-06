<?php

namespace App\Filament\Resources\LectureSessions\RelationManagers;

use Filament\Actions\Action;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AttendanceExport;


class AttendancesRelationManager extends RelationManager
{
    protected static string $relationship = 'attendances';

    public static function getTitle(?Model $ownerRecord = null, ?string $pageClass = null): string
    {
        return __('attendance.present_students');
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('student.name')
                    ->label(__('attendance.student_name'))
                    ->searchable(),

                TextColumn::make('student.student_number')
                    ->label(__('attendance.student_number'))
                    ->searchable(),

                TextColumn::make('attendance_time')
                    ->label(__('attendance.attendance_time'))
                    ->dateTime(),

            ])
            ->headerActions([
                Action::make('export_excel')
                    ->label(__('attendance.export_excel'))
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function ($livewire) {

                        $records = $livewire->getRelationship()->with('student')->get();

                        return Excel::download(
                            new AttendanceExport($records),
                            'attendance.xlsx'
                        );
                    }),


            ])
            ->filters([
                //
            ])
            ->recordActions([])
            ->toolbarActions([]);
    }
}



