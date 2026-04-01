<?php

namespace App\Filament\Resources\Payments\Schemas;

use App\Models\Client;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detalles del Ingreso')
                    ->columnSpanFull()
                    ->schema([

                        Select::make('client_id')
                            ->label('Cliente')
                            ->relationship('client', 'full_name')
                            ->options(Client::where('client_type', 'cliente')->pluck('full_name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->columnSpanFull(),

                        Grid::make(2)->schema([
                            TextInput::make('amount')
                                ->label('Monto Recibido')
                                ->numeric()
                                ->prefix('$')
                                ->required(),

                            Select::make('payment_method')
                                ->label('Método de Pago')
                                ->options([
                                    'Efectivo' => 'Efectivo',
                                    'Transferencia' => 'Transferencia Bancaria',
                                    'Tarjeta' => 'Tarjeta Crédito/Débito',
                                    'Cheque' => 'Cheque',
                                    'Otro' => 'Otro',
                                ])
                                ->required()
                                ->native(false),
                        ]),

                        TextInput::make('concept')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('transaction_reference')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Select::make('paymentable_selector')
                            ->label('¿Este pago pertenece a?')
                            ->options([
                                'case' => 'Un Caso',
                                'recurrent' => 'Pago Recurrente (Iguala)',
                                'procedure' => 'Un Trámite',
                            ])
                            ->live()
                            ->required()
                            ->columnSpanFull(),

                        Select::make('paymentable_id')
                            ->label('Seleccionar Caso')
                            ->options(function (Get $get) {
                                if (!$get('client_id')) {
                                    return [];
                                }

                                return \App\Models\ClientCase::where('client_id', $get('client_id'))
                                    ->pluck('case_name', 'id')
                                    ->toArray();
                            })
                            ->visible(
                                fn(Get $get) =>
                                $get('paymentable_selector') === 'case'
                                    && filled($get('client_id'))
                            )
                            ->dehydrated(
                                fn(Get $get) =>
                                $get('paymentable_selector') === 'case'
                            )
                            ->required(
                                fn(Get $get) =>
                                $get('paymentable_selector') === 'case'
                            )
                            ->columnSpanFull(),

                        Select::make('paymentable_id')
                            ->label('Seleccionar Trámite')
                            ->options(function (Get $get) {
                                if (!$get('client_id')) return [];
                                return \App\Models\Procedure::whereHas('clientCase', fn($q) => $q->where('client_id', $get('client_id')))
                                    ->pluck('title', 'id');
                            })
                            ->visible(fn(Get $get) => $get('paymentable_selector') === 'procedure')
                            ->required(fn(Get $get) => $get('paymentable_selector') === 'procedure'),

                        Select::make('recurrent_payment_id')
                            ->label('Seleccionar Pago Recurrente')
                            ->options(function (Get $get) {
                                if (!$get('client_id')) {
                                    return [];
                                }

                                return \App\Models\RecurrentPayment::where('client_id', $get('client_id'))
                                    ->pluck('title', 'id')
                                    ->toArray();
                            })
                            ->visible(
                                fn(Get $get) =>
                                $get('paymentable_selector') === 'recurrent'
                                    && filled($get('client_id'))
                            )
                            ->dehydrated(
                                fn(Get $get) =>
                                $get('paymentable_selector') === 'recurrent'
                            )
                            ->required(
                                fn(Get $get) =>
                                $get('paymentable_selector') === 'recurrent'
                            )
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
