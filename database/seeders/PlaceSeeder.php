<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Place::create([
            'name' => 'Universidad de Sevilla',
            'direction' => 'C. San Fernando, 4, 41004 Sevilla'

        ]);
        Place::create([
            'name' => 'Universidad de Málaga',
            'direction' => 'Av. de Cervantes, 2, 29016 Málaga'
        ]);
        Place::create([
            'name' => 'IES Hermanos Machado',
            'direction' => 'Via Flaminia, s/n, 41089 Dos Hermanas, Sevilla'

        ]);
        Place::create([
            'name' => 'Biblioteca Felipe González Márquez',
            'direction' => 'C. Torneo, s/n, 41002 Sevilla'
        ]);

    }


}
