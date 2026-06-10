<?php

namespace App\Filament\Resources\Aboutmes;

use App\Filament\Resources\Aboutmes\Pages\CreateAboutme;
use App\Filament\Resources\Aboutmes\Pages\EditAboutme;
use App\Filament\Resources\Aboutmes\Pages\ListAboutmes;
use App\Filament\Resources\Aboutmes\Tables\AboutmesTable;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use App\Models\Aboutme;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AboutmeResource extends Resource
{
    protected static ?string $model = Aboutme::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Profil Universitas';
    protected static ?string $modelLabel = 'Profil';
    protected static ?string $pluralModelLabel = 'Profil Universitas';
    protected static string|UnitEnum|null $navigationGroup = 'Profil Universitas';
    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'content';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('profil')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return AboutmesTable::configure($table);
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
            'index' => ListAboutmes::route('/'),
            'create' => CreateAboutme::route('/create'),
            'edit' => EditAboutme::route('/{record}/edit'),
        ];
    }
}