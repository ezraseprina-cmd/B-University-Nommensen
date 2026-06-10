<?php

namespace App\Filament\Resources\Footers;

use App\Filament\Resources\Footers\Pages\CreateFooter;
use App\Filament\Resources\Footers\Pages\EditFooter;
use App\Filament\Resources\Footers\Pages\ListFooters;
use App\Filament\Resources\Footers\Schemas\FooterForm;
use App\Filament\Resources\Footers\Tables\FootersTable;
use App\Models\Footer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;

class FooterResource extends Resource
{
    protected static ?string $model = Footer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Pengaturan Footer';
    protected static ?string $modelLabel = 'Footer';
    protected static ?string $pluralModelLabel = 'Pengaturan Footer';
    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan';
    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'Footer';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            // ====================================================
            // SECTION 1: Identitas & Lokasi Universitas
            // ====================================================
            Section::make('Identitas & Lokasi')
                ->description('Logo, alamat, dan peta lokasi yang ditampilkan di footer website.')
                ->icon('heroicon-o-map-pin')
                ->schema([
                    FileUpload::make('image')
                        ->label('Logo Universitas')
                        ->image()
                        ->directory('footers')
                        ->visibility('public')
                        ->imagePreviewHeight('120')
                        ->maxSize(2048)
                        ->required()
                        ->helperText('Logo putih/transparan paling cocok untuk footer.')
                        ->columnSpanFull(),

                    TextInput::make('alamat')
                        ->label('Alamat Lengkap')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('contoh: Jl. Pendidikan No. 1, Pematangsiantar, Sumatera Utara 21121')
                        ->columnSpanFull(),

                    TextInput::make('link_gmaps')
                        ->label('Link Google Maps (Embed URL)')
                        ->url()
                        ->required()
                        ->maxLength(255)
                        ->placeholder('https://www.google.com/maps/embed?pb=...')
                        ->helperText('Buka Google Maps → cari lokasi → Share → Embed a map → copy URL src.')
                        ->columnSpanFull(),
                ]),

            // ====================================================
            // SECTION 2: Kontak Resmi
            // ====================================================
            Section::make('Kontak Resmi')
                ->description('Email dan nomor WhatsApp yang bisa dihubungi pengunjung website.')
                ->icon('heroicon-o-phone')
                ->schema([
                    TextInput::make('email')
                        ->label('Email Kontak')
                        ->email()
                        ->required()
                        ->maxLength(255)
                        ->prefix('@')
                        ->placeholder('contoh: info@b-university.ac.id'),

                    TextInput::make('wa')
                        ->label('Nomor WhatsApp')
                        ->required()
                        ->maxLength(255)
                        ->prefix('+62')
                        ->placeholder('contoh: 81234567890')
                        ->helperText('Tulis tanpa angka 0 di depan dan tanpa +62 (sudah di-prefix).'),
                ])
                ->columns(2),

            // ====================================================
            // SECTION 3: Sosial Media
            // ====================================================
            Section::make('Sosial Media')
                ->description('Link akun resmi universitas di berbagai platform sosial media.')
                ->icon('heroicon-o-globe-alt')
                ->schema([
                    TextInput::make('link_instagram')
                        ->label('Instagram')
                        ->url()
                        ->required()
                        ->maxLength(255)
                        ->prefix('🌐')
                        ->placeholder('https://instagram.com/buniversity'),

                    TextInput::make('link_youtube')
                        ->label('YouTube')
                        ->url()
                        ->required()
                        ->maxLength(255)
                        ->prefix('🌐')
                        ->placeholder('https://youtube.com/@buniversity'),

                    TextInput::make('link_linkedin')
                        ->label('LinkedIn')
                        ->url()
                        ->required()
                        ->maxLength(255)
                        ->prefix('🌐')
                        ->placeholder('https://linkedin.com/school/buniversity'),

                    TextInput::make('link_facebook')
                        ->label('Facebook')
                        ->url()
                        ->required()
                        ->maxLength(255)
                        ->prefix('🌐')
                        ->placeholder('https://facebook.com/buniversity'),
                ])
                ->columns(2),
        ])
        ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return FootersTable::table($table);
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
            'index' => ListFooters::route('/'),
            'create' => CreateFooter::route('/create'),
            'edit' => EditFooter::route('/{record}/edit'),
        ];
    }
}