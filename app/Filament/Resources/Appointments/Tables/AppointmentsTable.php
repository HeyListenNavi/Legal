<?php

namespace App\Filament\Resources\Appointments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class AppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date_time')
                    ->dateTime()
                    ->label("Fecha y hora"),
                TextColumn::make("responsable_lawyer")
                    ->label("Responsable")
                    ->badge(),
                TextColumn::make("status")
                    ->label("Estatus")
                    ->badge(),
                TextColumn::make("modality")
                    ->label("Modalidad")
                    ->badge(),
                
                
                

                
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}