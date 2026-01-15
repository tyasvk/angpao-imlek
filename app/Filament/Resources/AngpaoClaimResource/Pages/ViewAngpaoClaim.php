<?php

namespace App\Filament\Resources\AngpaoClaimResource\Pages;

use App\Filament\Resources\AngpaoClaimResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAngpaoClaim extends ViewRecord
{
    protected static string $resource = AngpaoClaimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
