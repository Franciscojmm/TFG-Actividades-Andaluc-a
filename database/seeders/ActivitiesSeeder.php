<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha_actual = date("Y/m/d H:i:s");

        Activity::create([
            'name' => 'Enseñanza a los más pequeños',
            'description' => 'Una conferencia sobre como educar a los más pequeños de los colegios.',
            'date' => date("Y/m/d H:i:s" , strtotime($fecha_actual."+ 1 month")),
            'teaching' => 1,
            'place' => 1,
            'type' => 1
        ]);

        Activity::create([
            'name' => 'Enseña Matematicas de forma divertida',
            'description' => 'Exposición donde explicarán como dar clases de mátematicas de forma más entretenida.',
            'date' => date("Y/m/d H:i:s" , strtotime($fecha_actual."+ 1 week")),
            'teaching' => 2,
            'place' => 3,
            'type' => 4
        ]);

        Activity::create([
            'name' => 'Reunión para los maestros de Infantil',
            'description' => 'Una reunión informativa.',
            'date' => date("Y/m/d H:i:s" , strtotime($fecha_actual."+ 1 month")),
            'teaching' => 1,
            'place' => 2,
            'type' => 3
        ]);

        Activity::create([
            'name' => 'Exposición material Lengua castellana y literatura.',
            'description' => 'Temario que deberan tratar los profesores de Lengua y Literatura.',
            'date' => date("Y/m/d H:i:s" , strtotime($fecha_actual."+ 2 week")),
            'teaching' => 3,
            'place' => 1,
            'type' => 4
        ]);

        Activity::create([
            'name' => 'Seminario FP',
            'description' => 'Seminario para los profesores que imparten FP en los centros de Andalucía.',
            'date' => date("Y/m/d H:i:s" , strtotime($fecha_actual."+ 5 days")),
            'teaching' => 5,
            'place' => 1,
            'type' => 2
        ]);

        Activity::create([
            'name' => 'Seminario FP Avanzado',
            'description' => 'Seminario para los profesores que imparten FP en los centros de Andalucía.',
            'date' => date("Y/m/d H:i:s" , strtotime($fecha_actual."- 5 days")),
            'teaching' => 5,
            'place' => 2,
            'type' => 2
        ]);

        Activity::create([
            'name' => 'Mesa de Trabajo FP',
            'description' => 'Seminario para los profesores que imparten FP en los centros de Andalucía.',
            'date' => date("Y/m/d H:i:s" , strtotime($fecha_actual."+ 5 days")),
            'teaching' => 5,
            'place' => 3,
            'type' => 3
        ]);


    }

}
