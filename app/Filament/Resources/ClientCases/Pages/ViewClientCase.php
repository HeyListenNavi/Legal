<?php

namespace App\Filament\Resources\ClientCases\Pages;

use App\Filament\Resources\ClientCases\ClientCaseResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewClientCase extends ViewRecord
{
    protected static string $resource = ClientCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
