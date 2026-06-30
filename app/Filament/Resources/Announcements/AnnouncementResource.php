<?php

namespace App\Filament\Resources\Announcements;

use App\Filament\Resources\Announcements\Pages\CreateAnnouncement;
use App\Filament\Resources\Announcements\Pages\EditAnnouncement;
use App\Filament\Resources\Announcements\Pages\ListAnnouncements;
use App\Filament\Resources\Announcements\Tables\AnnouncementsTable;
use App\Models\Announcement;
use Filament\Forms\Components\TextInput;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Hidden;
use UnitEnum;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Pengumuman';
    protected static ?string $modelLabel = 'Pengumuman';
    protected static ?string $pluralModelLabel = 'Pengumuman';
    protected static string|UnitEnum|null $navigationGroup = 'Publikasi';
    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'Announcement';

    public static function form(Schema $Schema): Schema
{
    return $Schema
        ->schema([
            TextInput::make('title')
                ->label('Judul Pengumuman')
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: Jadwal UAS Semester Ganjil 2025/2026')
                ->helperText('Slug URL akan dibuat otomatis dari judul ini.')
                ->columnSpanFull(),

            RichEditor::make('content')
                ->label('Isi Pengumuman')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'bulletList',
                    'orderedList',
                    'link',
                ])
                ->required()
                ->columnSpanFull(),

            Hidden::make('slug'),
            Hidden::make('users_id'),
        ]);
}

    public static function table(Table $table): Table
    {
        return AnnouncementsTable::table($table);
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
            'index' => ListAnnouncements::route('/'),
            'create' => CreateAnnouncement::route('/create'),
            'edit' => EditAnnouncement::route('/{record}/edit'),
        ];
    }
}