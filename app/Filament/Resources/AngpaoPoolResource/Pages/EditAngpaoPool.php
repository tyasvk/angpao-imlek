<?php

namespace App\Filament\Resources\AngpaoPoolResource\Pages;

use App\Filament\Resources\AngpaoPoolResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAngpaoPool extends EditRecord
{
    protected static string $resource = AngpaoPoolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
