<?php

namespace App\Filament\Resources\Appointments\Schemas;

use App\Models\Client;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class AppointmentsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('Tipo de cita')
                    ->schema([

                        Select::make('appointment_mode')
                            ->label('¿Es cliente o prospecto?')
                            ->options([
                                'client' => 'Cliente',
                                'prospect' => 'Prospecto',
                            ])
                            ->live()
                            ->required()
                            ->dehydrated(false)
                            ->columnSpanFull(),

                    ])
                    ->columnSpanFull(),

                Section::make('Seleccionar cliente')
                    ->schema([

                        Select::make('appointmentable_id')
                            ->label('Cliente')
                            ->options(Client::where('client_type', 'cliente')->pluck('full_name', 'id'))
                            ->searchable()
                            ->live()
                            ->required()
                            ->visible(fn (Get $get) => $get('appointment_mode') === 'client')
                            ->columnSpanFull(),

                        Select::make('case_id')
                            ->label('Caso (opcional)')
                            ->options(function (Get $get) {

                                $clientId = $get('appointmentable_id');

                                if (!$clientId) {
                                    return [];
                                }

                                return \App\Models\ClientCase::where('client_id', $clientId)
                                    ->pluck('case_name', 'id')
                                    ->toArray();
                            })
                            ->searchable()
                            ->reactive()
                            ->visible(fn (Get $get) =>
                                $get('appointment_mode') === 'client'
                                && filled($get('appointmentable_id'))
                            )
                            ->columnSpanFull(),

                    ]) // 👈 ESTE ERA EL QUE FALTABA
                    ->visible(fn (Get $get) => $get('appointment_mode') === 'client')
                    ->columnSpanFull(),

                Section::make('Datos del prospecto')
                    ->schema([

                        TextInput::make('prospect_full_name')
                            ->label('Nombre completo')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('prospect_phone')
                            ->label('Teléfono')
                            ->columnSpanFull(),

                        TextInput::make('prospect_email')
                            ->label('Correo')
                            ->email()
                            ->columnSpanFull(),

                    ])
                    ->visible(fn (Get $get) => $get('appointment_mode') === 'prospect')
                    ->dehydrated(false)
                    ->columnSpanFull(),

                Section::make('Información de la cita')
                    ->schema([

                        DateTimePicker::make('date_time')
                            ->label('Fecha y hora')
                            ->seconds(false)
                            ->native(false)
                            ->required()
                            ->columnSpanFull(),

                        Select::make('responsable_lawyer')
                            ->relationship('responsable', 'name')
                            ->required()
                            ->columnSpanFull(),

                        Select::make('status')
                            ->options([
                                'pending' => 'Pendiente',
                                'confirmed' => 'Confirmada',
                                'cancelled' => 'Cancelada',
                            ])
                            ->default('pending')
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('reason')
                            ->label('Motivo')
                            ->required()
                            ->columnSpanFull(),

                    ])
                    ->columnSpanFull(),

            ]);
    }
}
