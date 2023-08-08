<?php

namespace Database\Seeders;

use App\Models\TipeKamar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipeKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipeKamar::insert([
            ['tipe'=> 'VVIP', 'harga'=> '300000'],
            ['tipe'=> 'VIP', 'harga'=> '250000'],
            ['tipe'=> 'BIASA', 'harga'=> '200000'],
            ['tipe'=> 'KIPAS', 'harga'=> '150000'],
        ]);
    }
}
