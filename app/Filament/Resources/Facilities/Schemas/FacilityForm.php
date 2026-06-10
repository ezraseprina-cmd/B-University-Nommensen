<?php

namespace App\Filament\Resources\Facilities\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class FacilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                RichEditor::make('content')
                    ->label('Deskripsi Fasilitas')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'bulletList',
                        'orderedList',
                        'link',
                        'h3',
                        'h4',
                    ])
                    ->required()
                    ->helperText('Jelaskan fasilitas kampus secara detail.')
                    ->columnSpanFull(),
    
                FileUpload::make('image')
                    ->label('Foto Fasilitas')
                    ->image()
                    ->directory('facilities')
                    ->visibility('public')
                    ->imagePreviewHeight('200')
                    ->maxSize(3072)
                    ->required()
                    ->helperText('Upload foto fasilitas. Format: JPG, PNG. Maks 3MB.')
                    ->columnSpanFull(),
            ]);
    }
}