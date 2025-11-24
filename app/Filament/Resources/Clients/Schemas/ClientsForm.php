<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea; 

class ClientsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('full_name')
                    ->label("Nombre completo")
                    ->columnSpanFull(),
                TextInput::make('phone_number')
                    ->label("Telefono")
                    ->required(),
                DatePicker::make('date_of_birth')
                    ->label("Fecha de nacimiento"),
                Select::make('person_type')
                    ->required()
                    ->label("Tipo de persona")
                    ->options([
                        'persona_fisica' => 'Persona Fisica',
                        'persona_moral' => 'Persona Moral',
                    ]),
                TextInput::make("occupation")
                    ->label("A que se dedica"),
                TextInput::make("email")
                    ->label("Correo electronico"),
                TextInput::make("curp")
                    ->label("CURP")
                    ->required(),
                TextInput::make("rfc")
                    ->label("RFC"),
                TextInput::make("ine_id")
                    ->label("INE"),
                Textarea::make("address")  
                    ->label("Direccion")
                    ->columnSpanFull()
                    ->rows(6),
            ]);
    }
}
