<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Pepe',
            'surname' => 'Navarro',
            'email' => 'pepito123@gmail.com',
            'dni' => '72757677S',
            'body' => 1,
            'center_code' => '41700181',
            'password' => Hash::make('Pepito123!'),
        ])->assignRole('encargado');

        User::create([
            'name' => 'Juan',
            'surname' => 'Rodriguez',
            'email' => 'juan123@gmail.com',
            'dni' => '12345567L',
            'body' => 5,
            'center_code' => '41702181',
            'password' => Hash::make('Juan123!'),
        ])->assignRole('profesor');

        User::create([
            'name' => 'Alfredo',
            'surname' => 'Gonzalez',
            'email' => 'alfredo123@gmail.com',
            'dni' => '98765567K',
            'body' => 5,
            'center_code' => '41702181',
            'password' => Hash::make('Alfredo123!'),
        ])->assignRole('profesor');


        User::create([
            'name' => 'Lucía',
            'surname' => 'Alonso',
            'email' => 'lucia123@gmail.com',
            'dni' => '49995567F',
            'body' => 5,
            'center_code' => '41702181',
            'password' => Hash::make('Lucia123!'),
        ])->assignRole('profesor');



        User::create([
            'name' => 'Fernando',
            'surname' => 'Lopez',
            'email' => 'fernado123@gmail.com',
            'dni' => '33456678s',
            'body' => 4,
            'center_code' => '41702181',
            'password' => Hash::make('Fernando123!'),
        ])->assignRole('profesor');

        User::create([
            'name' => 'María',
            'surname' => 'Rodriguez',
            'email' => 'maria123@gmail.com',
            'dni' => '45456678f',
            'body' => 2,
            'center_code' => '41702181',
            'password' => Hash::make('Maria123!'),
        ])->assignRole('profesor');


        User::create([
            'name' => 'Ana',
            'surname' => 'Dominguez',
            'email' => 'ana123@gmail.com',
            'dni' => '62456678J',
            'body' => 3,
            'center_code' => '41702181',
            'password' => Hash::make('Ana123!'),
        ])->assignRole('profesor');

        User::create([
            'name' => 'Alonso',
            'surname' => 'Martín',
            'email' => 'alonso123@gmail.com',
            'dni' => '90456678D',
            'body' => 2,
            'center_code' => '41702181',
            'password' => Hash::make('Alonso123!'),
        ])->assignRole('profesor');

    }

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'surname' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'dni' => $this->faker->unique()->dni,
            'body' => $this->faker->name,
            'center_code' => $this->faker->number,
            'password' => Hash::make($this->faker->name)
        ];

    }
}
