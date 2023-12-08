<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password'=> bcrypt('12345678'),
            'no_hp'=> '12345678',
            'role'=> 'Admin'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Pemilik',
            'email' => 'Pemilik@gmail.com',
            'password'=> bcrypt('12345678'),
            'no_hp'=> '12345678',
            'role'=> 'Pemilik'
        ]);
        $this->call([
            TipeKamarSeeder::class,
            KamarSeeder::class,
        ]);
    }
}
