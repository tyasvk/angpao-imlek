<?php

namespace App\Filament\Resources\AngpaoPoolResource\Pages;

use App\Filament\Resources\AngpaoPoolResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAngpaoPools extends ListRecords
{
    protected static string $resource = AngpaoPoolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
