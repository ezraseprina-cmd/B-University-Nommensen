<?php

namespace App\Filament\Resources\News;

use App\Filament\Resources\News\Pages\CreateNews;
use App\Filament\Resources\News\Pages\EditNews;
use App\Filament\Resources\News\Pages\ListNews;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use App\Filament\Resources\News\Tables\NewsTable;
use App\Models\News;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $modelLabel = 'Berita';
    protected static ?string $pluralModelLabel = 'Berita';
    protected static string|UnitEnum|null $navigationGroup = 'Publikasi';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
{
    return $schema
        ->components([
            TextInput::make('title')
                ->label('Judul Berita')
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: B University Raih Akreditasi Unggul')
                ->helperText('Slug URL akan dibuat otomatis dari judul ini.')
                ->columnSpanFull(),

            RichEditor::make('content')
                ->label('Isi Berita')
                ->json(false)
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'bulletList',
                    'orderedList',
                    'link',
                    'h2',
                    'h3',
                ])
                ->required()
                ->columnSpanFull(),

            FileUpload::make('image')
                ->label('Foto Berita')
                ->image()
                ->disk('public')
                ->directory('news')
                ->visibility('public')
                ->imagePreviewHeight('200')
                ->maxSize(3072)
                ->required()
                ->helperText('Foto utama berita. Format: JPG, PNG. Maks 3MB.')
                ->columnSpanFull(),

            Hidden::make('slug'),
            Hidden::make('users_id'),
        ]);
}
    public static function table(Table $table): Table
    {
        return NewsTable::table($table);
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
            'index' => ListNews::route('/'),
            'create' => CreateNews::route('/create'),
            'edit' => EditNews::route('/{record}/edit'),
        ];
    }
}