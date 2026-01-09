<?php

namespace App\Filament\Resources\InstructorApplicationResource\Pages;

use App\Filament\Resources\InstructorApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInstructorApplication extends ViewRecord
{
    protected static string $resource = InstructorApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}