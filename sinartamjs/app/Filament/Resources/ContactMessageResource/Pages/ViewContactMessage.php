<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Resources\Pages\ViewRecord;

class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Auto mark as read saat dibuka
        if (!$this->record->is_read) {
            $this->record->markAsRead();
        }

        return $data;
    }
}