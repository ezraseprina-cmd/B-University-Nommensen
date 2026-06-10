<?php

namespace App\Filament\Resources\Greetings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;
class GreetingsTable
{
    public static function configure(Table $table): Table
{
    return $table
        ->columns([
            ImageColumn::make('image')
                ->label('Foto')
                ->disk('public')
                ->height(60)
                ->circular(),

            TextColumn::make('content')
                ->label('Cuplikan Sambutan')
                ->formatStateUsing(fn (?string $state): string => Str::limit(strip_tags($state ?? ''), 80))
                ->wrap(),

            TextColumn::make('created_at')
                ->label('Ditambahkan')
                ->dateTime('d M Y H:i')
                ->sortable()
                ->toggleable(),

            TextColumn::make('updated_at')
                ->label('Diperbarui')
                ->dateTime('d M Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            //
        ])
        ->actions([
            EditAction::make(),
            DeleteAction::make(),
        ])
        ->bulkActions([
            BulkActionGroup::make([
            DeleteBulkAction::make(),
            ]),
        ])
        ->defaultSort('created_at', 'desc');
}
}