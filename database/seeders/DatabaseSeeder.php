<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesAndPermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //crear usuario eventmanager@example.com
        \App\Models\User::factory()->create([
            'name' => 'Event Manager',
            'email' => 'eventmanager@example.com',
            'password' => bcrypt('12345678')
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('12345678')
        ]);
        $this->call([ RolesAndPermissionsSeeder::class, ]);
        $this->call([ SpeakerSeeder::class, ]);
        $this->call([ EventSeeder::class, ]);
    }
}
