<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User_activities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;



class User_ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User_activities::create([
            'id_user' => 2,
            'id_activity'=> 1
            ]);
        User_activities::create([
            'id_user' => 2,
            'id_activity'=> 2
        ]);
        User_activities::create([
            'id_user' => 2,
            'id_activity'=> 3
        ]);
        User_activities::create([
        'id_user' => 2,
        'id_activity'=> 4
        ]);
        User_activities::create([
            'id_user' => 2,
            'id_activity'=> 5
        ]);

    }

}