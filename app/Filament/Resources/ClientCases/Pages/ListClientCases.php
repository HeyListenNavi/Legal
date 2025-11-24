<?php

namespace App\Filament\Resources\ClientCases\Pages;

use App\Filament\Resources\ClientCases\ClientCaseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClientCases extends ListRecords
{
    protected static string $resource = ClientCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
