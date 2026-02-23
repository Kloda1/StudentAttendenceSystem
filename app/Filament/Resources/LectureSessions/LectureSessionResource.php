<?php

namespace App\Filament\Resources\LectureSessions;

use App\Filament\Resources\LectureSessions\Pages\CreateLectureSession;
use App\Filament\Resources\LectureSessions\Pages\EditLectureSession;
use App\Filament\Resources\LectureSessions\Pages\ListLectureSessions;
use App\Filament\Resources\LectureSessions\Pages\ViewLectureSession;
use App\Filament\Resources\LectureSessions\Schemas\LectureSessionForm;
use App\Filament\Resources\LectureSessions\Schemas\LectureSessionInfolist;
use App\Filament\Resources\LectureSessions\Tables\LectureSessionsTable;
use App\Models\LectureSession;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LectureSessionResource extends Resource
{
    protected static ?string $model = LectureSession::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'LectureSession';

    public static function form(Schema $schema): Schema
    {
        return LectureSessionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LectureSessionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LectureSessionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLectureSessions::route('/'),
            'create' => CreateLectureSession::route('/create'),
            'view' => ViewLectureSession::route('/{record}'),
            'edit' => EditLectureSession::route('/{record}/edit'),
        ];
    }
}
