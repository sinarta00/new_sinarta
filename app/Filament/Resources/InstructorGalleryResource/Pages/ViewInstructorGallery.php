<?php

namespace App\Filament\Resources\InstructorGalleryResource\Pages;

use App\Filament\Resources\InstructorGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInstructorGallery extends ViewRecord
{
    protected static string $resource = InstructorGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
