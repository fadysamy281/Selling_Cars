<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {/*
                $users=BD::table('users')->chunks(5,function($musers){
                   foreach($musers as $user)
                   $user->pluck('id');
               })->toArray();
             
       */
        $names=cars_trade_marks();
        $users=User::limit(5)->pluck('id')->toArray();
     for($i=1;$i<9;$i++){   
              DB::table('cars')->insert([

             'owner_id'=>$users[rand(0,count($users)-1)],
            'name' => $names[rand(0,count($names)-1)],
            'description' => Str::random(30),
            'color' => Str::random(7),

            'unit_price' => rand(0,1000)+0.25,
             'quantity'=>rand(0,1000),
        ]);}
    }
}
