<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Talk;
use App\Models\Speaker;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear el evento principal
        $event = Event::create([
            'name' => 'Diálogos Negocios y Finanzas',
            'description' => 'Evento enfocado en negocios y finanzas con expertos en el tema.',
            'start_date' => '2025-02-06 09:00:00',
            'end_date' => '2025-02-08 17:00:00',
            'location' => 'Centro de Convenciones',
            'user_id' => 1, // Ajusta según el organizador del evento
        ]);

        // Crear las charlas (Talks)
        $talks = [
            // Jueves 6 de febrero
            [
                'title' => 'Inauguración',
                'description' => 'Inauguración del evento.',
                'start_time' => '2025-02-06 09:00:00',
                'end_time' => '2025-02-06 10:00:00',
                'speaker_id' => Speaker::where('name', 'Alejandra Patiño')->value('id'),
            ],
            [
                'title' => '¿Cuáles son los intereses de la Banca de Inversión para este 2025?',
                'description' => 'Perspectiva sobre las tendencias bancarias.',
                'start_time' => '2025-02-06 10:00:00',
                'end_time' => '2025-02-06 11:00:00',
                'speaker_id' => Speaker::where('name', 'Gerardo Sánchez')->value('id'),
            ],
            [
                'title' => 'Masterclass Fondos de Inversión',
                'description' => 'Sesión intensiva sobre fondos de inversión.',
                'start_time' => '2025-02-06 11:00:00',
                'end_time' => '2025-02-06 12:00:00',
                'speaker_id' => Speaker::where('name', 'Mónica Peña')->value('id'),
            ],
            [
                'title' => 'Personal branding: tu marca en un mercado incierto',
                'description' => 'Cómo construir una marca personal.',
                'start_time' => '2025-02-06 12:00:00',
                'end_time' => '2025-02-06 13:00:00',
                'speaker_id' => Speaker::where('name', 'Jaime Romo')->value('id'),
            ],
            [
                'title' => 'Aspectos Esenciales de la Certificación AMIB',
                'description' => 'Puntos clave sobre la certificación AMIB.',
                'start_time' => '2025-02-06 13:00:00',
                'end_time' => '2025-02-06 14:00:00',
                'speaker_id' => Speaker::where('name', 'Verónica Suárez')->value('id'),
            ],
            [
                'title' => '¿Competitividad en la 4T?',
                'description' => 'Reflexión sobre la competitividad en la 4T.',
                'start_time' => '2025-02-06 16:00:00',
                'end_time' => '2025-02-06 17:00:00',
                'speaker_id' => Speaker::where('name', 'Adalberto Albrecht')->value('id'),
            ],

            // Viernes 7 de febrero
            [
                'title' => 'Estudio Financiero para un plan de Negocios, una visión metodológica',
                'description' => null,
                'start_time' => '2025-02-07 09:00:00',
                'end_time' => '2025-02-07 10:00:00',
                'speaker_id' => Speaker::where('name', 'Ricardo Pelagio Morales')->value('id'),
            ],
            [
                'title' => 'Tendencias en la fuerza de trabajo global',
                'description' => null,
                'start_time' => '2025-02-07 11:00:00',
                'end_time' => '2025-02-07 12:00:00',
                'speaker_id' => Speaker::where('name', 'Alma González')->value('id'),
            ],

            // Puedes continuar con las demás charlas siguiendo el mismo formato.
        ];

        foreach ($talks as $talk) {
            $event->talks()->create($talk);
        }
    }
}
