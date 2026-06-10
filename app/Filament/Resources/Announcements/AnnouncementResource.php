<?php

namespace App\Filament\Resources\Announcements;

use App\Filament\Resources\Announcements\Pages\CreateAnnouncement;
use App\Filament\Resources\Announcements\Pages\EditAnnouncement;
use App\Filament\Resources\Announcements\Pages\ListAnnouncements;
use App\Filament\Resources\Announcements\Tables\AnnouncementsTable;
use App\Models\Announcement;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
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

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('content')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('users_id')
                    ->required()
                    ->numeric(),
                TextInput::make('slug')
                    ->required(),
            ])
            ->columns(1); 
    }

    public static function table(Table $table): Table
    {
        return AnnouncementsTable::configure($table);
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