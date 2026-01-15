<?php

namespace App\Filament\Resources\AngpaoClaimResource\Pages;

use App\Filament\Resources\AngpaoClaimResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAngpaoClaim extends EditRecord
{
    protected static string $resource = AngpaoClaimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
