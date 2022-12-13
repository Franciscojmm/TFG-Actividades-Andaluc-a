<?php

namespace Database\Seeders;

use App\Models\type_activities;
use Illuminate\Database\Seeder;

class Type_ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       type_activities::create([
            'name' => 'Conferencia'
        ]);
        type_activities::create([
            'name' => 'Seminario'
        ]);
        type_activities::create([
        'name' => 'Mesa de Trabajo'
        ]);
        type_activities::create([
            'name' => 'Exposicion de Material Didáctico'
        ]);
    }


}
