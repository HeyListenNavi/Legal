<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Appointments;
use App\Models\Client;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointments>
 */
class AppointmentsFactory extends Factory
{
    /**
     * El nombre del modelo correspondiente al factory.
     * (Opcional si sigues la convención de nombres, pero útil aquí)
     */
    protected $model = Appointments::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Genera una fecha entre hoy y dentro de 1 año
            "date_time" => fake()->dateTimeBetween('now', '+1 year'),
            
            "reason" => fake()->sentence(),
            
            // randomElement toma un array y elige uno
            "status" => fake()->randomElement(["Pendiente", "Cancelado", "Asistio"]),
            
            // Si tienes factories para Case y Lawyer, úsalos aquí: Case::factory()
            // Por ahora mantenemos números aleatorios como pediste
            "case_id" => fake()->numberBetween(1, 50),
            "responsable_lawyer" => fake()->numberBetween(1, 10),
            
            "modality" => fake()->randomElement(["Presencial", "Online", "Llamada"]),
            
            // Usamos text() o paragraph() para obtener un string, no un array
            "notes" => fake()->paragraph(),
            
            // Lógica Polimórfica Correcta:
            // Esto creará un Cliente cada vez que se cree una Cita para asegurar que el ID exista.
            'appointmentable_id' => Client::factory(),
            'appointmentable_type' => Client::class,
        ];
    }
}