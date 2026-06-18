<?php

namespace App\Filament\Resources\Students;

use App\Filament\Resources\Students\Pages\CreateStudent;
use App\Filament\Resources\Students\Pages\EditStudent;
use App\Filament\Resources\Students\Pages\ListStudents; 
use App\Filament\Resources\Students\Tables\StudentsTable;
use App\Models\Student;
use BackedEnum;
use Filament\Support\Icons\Heroicon;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Table;
use UnitEnum;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Mahasiswa';
    protected static ?string $modelLabel = 'Mahasiswa';
    protected static ?string $pluralModelLabel = 'Mahasiswa';
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen SDM';
    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'Student';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('namalengkap')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('contoh: Muhammad Rizky Pratama'),
    
                TextInput::make('namapanggilan')
                    ->label('Nama Panggilan')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('contoh: Rizky'),
    
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->placeholder('contoh: rizky.pratama@gmail.com'),
    
                TextInput::make('nomor_hp')
                    ->label('Nomor HP')
                    ->required()
                    ->maxLength(15)
                    ->placeholder('contoh: 081234567890')
                    ->helperText('Maksimal 15 digit, format 08xxxxxxxxxx.'),
    
                Select::make('jalur')
                    ->label('Jalur Masuk')
                    ->options([
                        'Reguler'  => 'Reguler',
                        'Beasiswa' => 'Beasiswa',
                        'Transfer' => 'Transfer',
                    ])
                    ->required()
                    ->placeholder('Pilih jalur masuk'),
    
                TextInput::make('programstudi_1')
                    ->label('Pilihan Program Studi 1')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('contoh: D3 Teknik Komputer'),
    
                TextInput::make('programstudi_2')
                    ->label('Pilihan Program Studi 2')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('contoh: D3 Sistem Informasi'),
    
                FileUpload::make('image')
                    ->label('Foto')
                    ->image()
                    ->directory('students')
                    ->visibility('public')
                    ->imagePreviewHeight('150')
                    ->maxSize(2048)
                    ->required()
                    ->helperText('Upload pas foto. Format: JPG, PNG. Maks 2MB.')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return StudentsTable::table($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStudents::route('/'),
            'create' => CreateStudent::route('/create'),
            'edit' => EditStudent::route('/{record}/edit'),
        ];
    }
}