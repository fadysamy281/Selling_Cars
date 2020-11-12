<?php

namespace Database\Seeders;
/*
use Database\Seeders\UsersSeeder;
use Database\Seeders\CarsSeeder;
use Database\Seeders\OrderDetailsSeeder;*/
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


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
                 $this->call(UsersSeeder::class);
                 $this->call(CarsSeeder::class);
                 $this->call(OrderDetailsSeeder::class);    
    }
}
