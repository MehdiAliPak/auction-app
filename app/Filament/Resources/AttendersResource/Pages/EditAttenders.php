<?php

namespace App\Filament\Resources\AttendersResource\Pages;

use App\Filament\Resources\AttendersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttenders extends EditRecord
{
    protected static string $resource = AttendersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
