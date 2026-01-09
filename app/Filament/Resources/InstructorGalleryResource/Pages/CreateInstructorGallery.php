<?php

namespace App\Filament\Resources\InstructorGalleryResource\Pages;

use App\Filament\Resources\InstructorGalleryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInstructorGallery extends CreateRecord
{
    protected static string $resource = InstructorGalleryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}