<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Car;
class OrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=User::limit(5)->pluck('id')->toArray();

               
        $cars=Car::limit(5)->pluck('id')->toArray();
          
             
     for($i=1;$i<9;$i++){   
         $car_id=$cars[rand(0,count($cars)-1)];
         $car=Car::find($car_id);
         $quantity=rand(0,1000);
              DB::table('order_details')->insert([

             'user_id'=>$users[rand(0,count($users)-1)],
            'car_id' => $car_id,
             'quantity'=>$quantity,

            'total_price' =>$car->unit_price*$quantity,
        ]);}        
    }
}
