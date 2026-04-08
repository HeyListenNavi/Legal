<?php

namespace App\Filament\Resources\ClientCases\Pages;

use App\Filament\Resources\ClientCases\ClientCaseResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewClientCase extends ViewRecord
{
    protected static string $resource = ClientCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('imprimir')
                ->label('Imprimir PDF')
                ->icon('heroicon-o-printer')
                ->color('gray')
                ->url(fn() => route('caso.imprimir', $this->record))
                ->openUrlInNewTab(),
            EditAction::make(),
        ];
    }
}
