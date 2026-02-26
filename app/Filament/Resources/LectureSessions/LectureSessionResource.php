<?php

namespace App\Filament\Resources\LectureSessions;

use App\Models\LectureSession;
use Filament\Resources\Resource;
use Filament\Schemas\Schema; // استيراد Schema
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use BackedEnum;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class LectureSessionResource extends Resource
{
    protected static ?string $model = LectureSession::class;


    protected static string|BackedEnum|null $navigationIcon =  Heroicon::RectangleStack;

    protected static ?string $recordTitleAttribute = 'LectureSession';

    protected static ?int $navigationSort = 2;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('lecturer_id', null)),
                Forms\Components\Select::make('hall_id')
                    ->relationship('hall', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\DatePicker::make('session_date')
                    ->required(),
                Forms\Components\TimePicker::make('start_time')
                    ->required(),
                Forms\Components\TimePicker::make('end_time')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'scheduled' => 'مجدولة',
                        'active' => 'نشطة',
                        'completed' => 'منتهية',
                        'cancelled' => 'ملغاة',
                    ])
                    ->default('scheduled')
                    ->required(),
                Forms\Components\Select::make('attendance_mode')
                    ->options([
                        'qr_only' => 'QR فقط',
                        'qr_otp' => 'QR + OTP',
                        'manual' => 'يدوي',
                    ])
                    ->default('qr_otp')
                    ->required(),
                Forms\Components\TextInput::make('qr_refresh_rate')
                    ->numeric()
                    ->default(40)
                    ->suffix('ثانية'),
                Forms\Components\Textarea::make('notes')
                    ->nullable(),
                 Forms\Components\Hidden::make('lecturer_id')
                    ->default(function (callable $get) {
                        $subjectId = $get('subject_id');
                        if ($subjectId) {
                            return \App\Models\Subject::find($subjectId)?->lecturer_id;
                        }
                        return auth()->id();
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hall.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('session_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->time(),
                Tables\Columns\TextColumn::make('end_time')
                    ->time(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'scheduled',
                        'success' => 'active',
                        'secondary' => 'completed',
                        'danger' => 'cancelled',
                    ]),
                Tables\Columns\TextColumn::make('actual_attendance')
                    ->label('الحضور الفعلي'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('subject')
                    ->relationship('subject', 'name'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'scheduled' => 'مجدولة',
                        'active' => 'نشطة',
                        'completed' => 'منتهية',
                        'cancelled' => 'ملغاة',
                    ]),
            ])
            ->actions([
                Action::make('start')
                    ->label('بدء الجلسة')
                    ->icon('heroicon-o-play')
                    ->color('success')
                    ->action(function (LectureSession $record) {
                        $record->update(['status' => 'active', 'actual_start' => now()]);
                        // هنا يمكنك إضافة كود لتوليد QR code و OTP
                    })
                    ->visible(fn (LectureSession $record) => $record->status === 'scheduled'),

                Action::make('end')
                    ->label('إنهاء الجلسة')
                    ->icon('heroicon-o-stop')
                    ->color('danger')
                    ->action(function (LectureSession $record) {
                        $record->update(['status' => 'completed', 'actual_end' => now()]);
                    })
                    ->visible(fn (LectureSession $record) => $record->status === 'active'),

                Action::make('view_qr')
                    ->label('عرض QR')
                    ->icon('heroicon-o-qr-code')
                    ->url(fn (LectureSession $record) => route('lecture-session.qr', $record))
                    ->openUrlInNewTab()
                    ->visible(fn (LectureSession $record) => $record->status === 'active'),

                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [

            // LectureSessionResource\RelationManagers\AttendancesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLectureSessions::route('/'),
            'create' => Pages\CreateLectureSession::route('/create'),
            'edit' => Pages\EditLectureSession::route('/{record}/edit'),
            'view' => Pages\ViewLectureSession::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()->hasRole('course_lecturer')) {

            return $query->where('lecturer_id', auth()->id());
        }

        return $query;
    }

    public static function canAccess(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'course_lecturer']);
    }
}
