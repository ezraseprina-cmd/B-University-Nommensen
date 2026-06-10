<?php

namespace App\Filament\Resources\Lectures;

use App\Filament\Resources\Lectures\Pages\CreateLecture;
use App\Filament\Resources\Lectures\Pages\EditLecture;
use App\Filament\Resources\Lectures\Pages\ListLectures;
use App\Filament\Resources\Lectures\Schemas\LectureForm;
use App\Filament\Resources\Lectures\Tables\LecturesTable;
use App\Models\Lecture;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class LectureResource extends Resource
{
    protected static ?string $model = Lecture::class;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Dosen';
    protected static ?string $modelLabel = 'Dosen';
    protected static ?string $pluralModelLabel = 'Dosen';
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen SDM';
    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
{
    return $schema->components([
            TextInput::make('nama')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: Dr. Ahmad Sutarno, M.Kom.'),

            TextInput::make('nidn')
                ->label('NIDN')
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: 0123456789')
                ->helperText('Nomor Induk Dosen Nasional (10 digit).'),

            TextInput::make('pendidikan')
                ->label('Riwayat Pendidikan')
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: S3 Teknik Informatika — Universitas Indonesia'),

            TextInput::make('jabatan')
                ->label('Jabatan Fungsional')
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: Lektor Kepala'),

            TextInput::make('email')
                ->label('Email Dosen')
                ->email()
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: ahmad@b-university.ac.id')
                ->helperText('Email aktif untuk komunikasi resmi.'),

            TextInput::make('topik')
                ->label('Topik / Bidang Keahlian')
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: Machine Learning, Data Mining'),

            FileUpload::make('image')
                ->label('Foto Dosen')
                ->image()
                ->directory('lectures')
                ->visibility('public')
                ->imagePreviewHeight('200')
                ->maxSize(2048)
                ->required()
                ->helperText('Upload foto formal dosen. Format: JPG, PNG. Maks 2MB.')
                ->columnSpanFull(),
        ])
        ->columns(2);
}

    public static function table(Table $table): Table
    {
        return LecturesTable::table($table);
    }

    public static function getRelations(): array
    {
        return [
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLectures::route('/'),
            'create' => CreateLecture::route('/create'),
            'edit' => EditLecture::route('/{record}/edit'),
        ];
    }
}