<?php

namespace App\Filament\Resources\Rektors;

use App\Filament\Resources\Rektors\Pages\CreateRektor;
use App\Filament\Resources\Rektors\Pages\EditRektor;
use App\Filament\Resources\Rektors\Pages\ListRektors;
use App\Filament\Resources\Rektors\Tables\RektorsTable;
use App\Models\Rektor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use UnitEnum;

class RektorResource extends Resource
{
    protected static ?string $model = Rektor::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Pimpinan';
    protected static ?string $modelLabel = 'Pimpinan';
    protected static ?string $pluralModelLabel = 'Pimpinan';
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen SDM';
    protected static ?int $navigationSort = 3;
    protected static ?string $recordTitleAttribute = 'Rektor';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
                    TextInput::make('nama')
                        ->label('Nama Lengkap')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('contoh: Prof. Dr. H. Maman Suherman, M.Pd.'),
        
                    TextInput::make('jabatan')
                        ->label('Jabatan')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('contoh: Rektor / Wakil Rektor I / Wakil Rektor II')
                        ->helperText('Tuliskan jabatan struktural di pimpinan universitas.'),
        
                    FileUpload::make('image')
                        ->label('Foto')
                        ->image()
                        ->directory('rektors')
                        ->visibility('public')
                        ->imagePreviewHeight('200')
                        ->maxSize(2048)
                        ->required()
                        ->helperText('Upload foto formal dengan latar polos. Format: JPG, PNG. Maks 2MB.')
                        ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return RektorsTable::table($table);
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
            'index' => ListRektors::route('/'),
            'create' => CreateRektor::route('/create'),
            'edit' => EditRektor::route('/{record}/edit'),
        ];
    }
}