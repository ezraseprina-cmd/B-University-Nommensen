<?php

namespace App\Filament\Resources\Cooperations\Forms;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CooperationSchema
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),

                FileUpload::make('image')
                    ->image()
                    ->directory('cooperations')
                    ->required(),
            ]);
    }
}