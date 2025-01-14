<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Speaker;

class SpeakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $speakers = [
            ['name' => 'Alejandra Patiño'],
            ['name' => 'Ricardo Pelagio Morales'],
            ['name' => 'Graciela Bribiesca'],
            ['name' => 'Gerardo Sánchez'],
            ['name' => 'José Luis García'],
            ['name' => 'Marcela Jímenez'],
            ['name' => 'Mónica Peña'],
            ['name' => 'Alma González'],
            ['name' => 'Miguel Maya'],
            ['name' => 'Jaime Romo'],
            ['name' => 'Victor Villegas'],
            ['name' => 'Verónica Suárez'],
            ['name' => 'Adalberto Albrecht'], 
        ];

        foreach ($speakers as $speaker) {
            Speaker::create($speaker);
        }
    }
}
