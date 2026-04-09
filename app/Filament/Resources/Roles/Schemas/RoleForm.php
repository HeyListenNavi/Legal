<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\CheckboxList;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Definición del Rol')
                    ->columnSpanFull()
                    ->description('Establezca el nombre y los privilegios de acceso.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre del Rol')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->placeholder('Ej. Admin, Visitador, Conexion...')
                            ->prefixIcon('heroicon-m-key')
                            ->columnSpanFull(),

                        Section::make('Privilegios de Acceso')
                            ->description('Seleccione qué acciones puede realizar este rol.')
                            ->columnSpan(2)
                            ->schema([
                                CheckboxList::make('permissions')
                                    ->label('Permisos')
                                    ->relationship('permissions', 'name')
                                    ->searchable()
                                    ->bulkToggleable()
                                    ->columns(2)
                                    ->gridDirection('row')
                                    ->getOptionLabelFromRecordUsing(
                                        fn($record) =>
                                        str($record->name)
                                            ->replace('.', ': ')
                                            ->replace('_', ' ')
                                            ->title()
                                    )
                            ]),
                    ]),
            ]);
    }
}
