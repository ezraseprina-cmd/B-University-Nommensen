<?php

namespace App\Filament\Resources\Announcements\Tables;

use Filament\Tables\Table;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

class AnnouncementsTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(50)
                    ->tooltip(fn (?string $state) => $state),

                TextColumn::make('content')
                    ->label('Cuplikan')
                    ->formatStateUsing(
                        fn (?string $state) =>
                        Str::limit(strip_tags($state ?? ''), 60)
                    )
                    ->wrap(),

                TextColumn::make('user.name')
                    ->label('Dibuat Oleh')
                    ->badge()
                    ->color('info')
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