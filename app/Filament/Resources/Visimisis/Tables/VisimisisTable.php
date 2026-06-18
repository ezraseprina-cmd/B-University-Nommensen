<?php

namespace App\Filament\Resources\Visimisis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class VisimisisTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->height(100)
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText(),

                    TextColumn::make('visi')
                    ->label('Visi')
                    ->limit(100)
                    ->grow()
                    ->formatStateUsing(
                        fn (?string $state): string => strip_tags($state ?? '')
                    )
                    ->wrap()
                    ->grow()
                    ->searchable()
                    ->tooltip(
                        fn (?string $state): ?string => strip_tags($state ?? '')
                    ),

                TextColumn::make('misi')
                    ->label('Misi')
                    ->limit(100)
                    ->grow()
                    ->formatStateUsing(
                        fn (?string $state): string => strip_tags($state ?? '')
                    )
                    ->wrap()
                    ->searchable()
                    ->tooltip(
                        fn (?string $state): ?string => strip_tags($state ?? '')
                    ),


                TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
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
            ->defaultSort('updated_at', 'desc');
    }
}