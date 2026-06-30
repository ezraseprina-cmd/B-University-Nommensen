<?php

namespace App\Filament\Resources\News\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;

class NewsTable
{
    public static function table(Table $table): Table
{
    return $table
        ->columns([
            ImageColumn::make('image')
                ->label('Foto')
                ->disk('public')
                ->height(60),

            TextColumn::make('title')
                ->label('Judul')
                ->searchable()
                ->sortable()
                ->weight('bold')
                ->limit(45)
                ->tooltip(fn (?string $state): ?string => $state),

            TextColumn::make('content')
                ->label('Cuplikan')
                ->formatStateUsing(fn (?string $state): string => Str::limit(strip_tags($state ?? ''), 60))
                ->wrap()
                ->toggleable(),

            TextColumn::make('user.name')
                ->label('Penulis')
                ->badge()
                ->color('success')
                ->sortable(),

                TextColumn::make('slug')
                ->label('Slug')
                ->searchable()
                ->copyable()
                ->copyMessage('Slug disalin!')
                ->limit(35),

            TextColumn::make('created_at')
                ->label('Diterbitkan')
                ->dateTime('d M Y H:i')
                ->sortable(),
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
