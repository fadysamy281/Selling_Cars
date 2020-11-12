<?php

namespace App\Traits;
use App\Models\OrderDetail;
use App\Models\Car;

trait OrdersTrait
{ 
	public function addOrder(Car $car,$quantity,$user){

	OrderDetail::create([
		'user_id'=>$user->id,
		'car_id'=>$car->id,
		'quantity'=>$quantity,
		'total_price'=>$quantity*$car->unit_price,
	]);
		
		$car->update(['quantity']=>$this->quantity-$quantity);}

		public function deleteOrders(Car $car){
			OrderDetail::where('car_id',$car->id)->chunk(5,function($morders){
				foreach($morders as $order)
					$order->delete();
			});
		}

    


}
