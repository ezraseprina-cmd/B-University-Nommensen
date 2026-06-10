<?php

namespace App\Filament\Resources\Admins;

use App\Filament\Resources\Admins\Pages\CreateAdmin;
use App\Filament\Resources\Admins\Pages\EditAdmin;
use App\Filament\Resources\Admins\Pages\ListAdmins;
use App\Filament\Resources\Admins\Schemas\AdminForm;
use App\Filament\Resources\Admins\Tables\AdminsTable;
use App\Models\Admin;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AdminResource extends Resource
{

    protected static ?string $model = Admin::class;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Admin / Staf';
    protected static ?string $modelLabel = 'Admin';
    protected static ?string $pluralModelLabel = 'Admin / Staf';
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen SDM';
    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'Admin';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('nama')
                        ->label('Nama Lengkap')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('contoh: Drs. Budi Santoso, M.M.'),
        
                    TextInput::make('nip')
                        ->label('NIP')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('contoh: 197505102001011001')
                        ->helperText('Nomor Induk Pegawai (boleh berupa NIP atau NIPK).'),
        
                    TextInput::make('jabatan')
                        ->label('Jabatan')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('contoh: Kepala Tata Usaha'),
        
                    FileUpload::make('image')
                        ->label('Foto')
                        ->image()
                        ->directory('admins')
                        ->visibility('public')
                        ->imagePreviewHeight('150')
                        ->maxSize(2048)
                        ->required()
                        ->helperText('Upload foto formal. Format: JPG, PNG. Maks 2MB.')
                        ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return AdminsTable::table($table);
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
            'index' => ListAdmins::route('/'),
            'create' => CreateAdmin::route('/create'),
            'edit' => EditAdmin::route('/{record}/edit'),
        ];
    }
}