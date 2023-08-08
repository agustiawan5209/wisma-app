<?php

namespace Database\Seeders;

use App\Models\DetailKamar;
use App\Models\Kamar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kamar::factory()->count(10)->create()->each(function($kamar){
            DetailKamar::create([
                'kamar_id'=> $kamar->id,
                'jenis'=> 'gambar',
                'detail'=> fake()->imageUrl(),
            ]);
            for ($i=0; $i < 5; $i++) {
                DetailKamar::create([
                    'kamar_id'=> $kamar->id,
                    'jenis'=> 'fasilitas',
                    'detail'=> fake()->realText(),
                ]);
            }
        });
    }
}
