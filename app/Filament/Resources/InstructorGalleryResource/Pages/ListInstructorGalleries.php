<?php

namespace App\Filament\Resources\InstructorGalleryResource\Pages;

use App\Filament\Resources\InstructorGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInstructorGalleries extends ListRecords
{
    protected static string $resource = InstructorGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Foto'),
        ];
    }
}