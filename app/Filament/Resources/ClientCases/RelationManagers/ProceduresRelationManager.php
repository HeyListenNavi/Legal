<?php

namespace App\Filament\Resources\ClientCases\RelationManagers;

use App\Filament\Resources\ClientCases\ClientCaseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class ProceduresRelationManager extends RelationManager
{
    protected static string $relationship = 'procedures';

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
