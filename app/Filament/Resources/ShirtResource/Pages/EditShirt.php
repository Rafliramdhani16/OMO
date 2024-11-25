<?php

namespace App\Filament\Resources\ShirtResource\Pages;

use App\Filament\Resources\ShirtResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShirt extends EditRecord
{
    protected static string $resource = ShirtResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
