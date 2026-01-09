<?php

namespace App\Filament\Resources\InstructorPageContentResource\Pages;

use App\Filament\Resources\InstructorPageContentResource;
use Filament\Resources\Pages\ListRecords;

class ListInstructorPageContents extends ListRecords
{
    protected static string $resource = InstructorPageContentResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}