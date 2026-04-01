<?php

namespace App\Filament\Resources\Appointments\Tables;

use App\Enums\AppointmentStatus;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date_time')
                    ->label("Fecha")
                    ->dateTime('l d M Y, h:i A')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('appointmentable.full_name')
                    ->label("Cliente")
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-m-user'),

                TextColumn::make('responsable.name')
                    ->label("Abogado")
                    ->badge()
                    ->color('gray')
                    ->searchable(),

                TextColumn::make("modality")
                    ->label("Modalidad")
                    ->badge()
                    ->icon(fn(string $state): string => match ($state) {
                        'Online' => 'heroicon-m-wifi',
                        'Presencial' => 'heroicon-m-building-office',
                        'Llamada' => 'heroicon-m-phone',
                        default => 'heroicon-m-question-mark-circle',
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'Presencial' => 'primary',
                        'Online' => 'info', // Changed to info for blue distinction
                        'Llamada' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make("status")
                    ->label("Estatus")
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        AppointmentStatus::Pending->value => 'warning',
                        AppointmentStatus::Confirmed->value => 'success',
                        AppointmentStatus::Cancelled->value => 'danger',
                        AppointmentStatus::Completed->value => 'success',
                        AppointmentStatus::RescheduleProposed->value => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        AppointmentStatus::Pending->value => 'Pendiente',
                        AppointmentStatus::Confirmed->value => 'Confirmada',
                        AppointmentStatus::Cancelled->value => 'Cancelada',
                        AppointmentStatus::Completed->value => 'Completada',
                        AppointmentStatus::RescheduleProposed->value => 'Reprogramación propuesta',
                        AppointmentStatus::Rejected => 'Rechazada',
                        AppointmentStatus::NoShow => 'No asistió',
                        default => ucfirst($state),
                    }),
            ])
            ->defaultSort('date_time', 'asc') // Show newest/upcoming first
            ->filters([
                // Filter 1: Quick Status check
                SelectFilter::make('status')
                    ->label('Estatus')
                    ->options(AppointmentStatus::options()),

                // Filter 2: Show only future appointments
                Filter::make('future')
                    ->label('Próximas Citas')
                    ->query(fn(Builder $query): Builder => $query->where('date_time', '>=', now()))
                    ->default(), // UX: Default to showing upcoming appointments
            ])
            ->headerActions([
                Action::make('sendWhatsAppLink')
                    ->label('Enviar Link WA')
                    ->icon('heroicon-m-chat-bubble-left-right')
                    ->color('success')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Número de WhatsApp')
                            ->required()
                            ->tel()
                            ->placeholder('Ej: 5512345678'),
                    ])
                    ->action(function ($record, array $data) {
                        $phone = $data['phone'];

                        $message = "Hola, te envío el link para agendar/revisar tu cita: " . route('appointments.schedule');

                        \App\WhatsApp\WhatsApp::sendText($phone, $message);
                    }),
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
