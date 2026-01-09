<?php

namespace App\Filament\Resources\InstructorPageContentResource\Pages;

use App\Filament\Resources\InstructorPageContentResource;
use Filament\Resources\Pages\EditRecord;

class EditInstructorPageContent extends EditRecord
{
    protected static string $resource = InstructorPageContentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}