<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RoleSeeder::class,
        ]);
        $this->call([
            TeachingSeeder::class,
        ]);
        $this->call([
            UserSeeder::class,
        ]);
        $this->call([
            Type_ActivitiesSeeder::class,
        ]);
        $this->call([
            PlaceSeeder::class,
        ]);
        $this->call([
            ActivitiesSeeder::class,
        ]);
        $this->call([
            User_ActivitySeeder::class,
        ]);


        // User::factory(20)->create()->assignRole('profesor');

    }
}
