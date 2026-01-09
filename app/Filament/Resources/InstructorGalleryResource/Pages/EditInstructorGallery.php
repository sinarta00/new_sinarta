<?php

namespace App\Filament\Resources\InstructorGalleryResource\Pages;

use App\Filament\Resources\InstructorGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInstructorGallery extends EditRecord
{
    protected static string $resource = InstructorGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}