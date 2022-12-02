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
            'dni'=>'72757677s',
            'body'=>'ESO',
            'center_code'=>'41700181',
            'password' => Hash::make('pepito123'),
        ]);

    }


}
