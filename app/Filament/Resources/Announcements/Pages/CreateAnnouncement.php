<?php

namespace App\Filament\Resources\Announcements\Pages;

use App\Filament\Resources\Announcements\AnnouncementResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CreateAnnouncement extends CreateRecord
{
    protected static string $resource = AnnouncementResource::class;

    /**
     * Hook yang dipanggil tepat sebelum data disimpan ke database.
     * Di sini kita mengisi slug (otomatis dari judul) dan users_id
     * (otomatis dari admin yang sedang login).
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug']     = Str::slug($data['title']) . '-' . time();
        $data['users_id'] = Auth::id();

        return $data;
    }
}