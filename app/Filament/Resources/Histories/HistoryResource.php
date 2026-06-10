<?php

namespace App\Filament\Resources\Histories;

use App\Filament\Resources\Histories\Pages\CreateHistory;
use App\Filament\Resources\Histories\Pages\EditHistory;
use App\Filament\Resources\Histories\Pages\ListHistories;
use App\Filament\Resources\Histories\Schemas\HistoryForm;
use App\Filament\Resources\Histories\Tables\HistoriesTable;
use App\Models\History;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;

class HistoryResource extends Resource
{
    protected static ?string $model = History::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Sejarah';
    protected static ?string $modelLabel = 'Sejarah';
    protected static ?string $pluralModelLabel = 'Sejarah';
    protected static string|UnitEnum|null $navigationGroup = 'Profil Universitas';
    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'History';

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
                    ->directory('sejarah')
                    ->required(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHistories::route('/'),
            'create' => CreateHistory::route('/create'),
            'edit' => EditHistory::route('/{record}/edit'),
        ];
    }
}