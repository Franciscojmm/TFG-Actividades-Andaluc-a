<?php

namespace Database\Seeders;

use App\Models\Teaching;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class TeachingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teaching::create([
            'name' => 'Infantil'
        ]);
        Teaching::create([
            'name' => 'Primaria'
        ]);
        Teaching::create([
            'name' => 'ESO'
        ]);
        Teaching::create([
            'name' => 'Bachilerato'
        ]);
        Teaching::create([
            'name' => 'Formación Profesional'
        ]);
    }


}
