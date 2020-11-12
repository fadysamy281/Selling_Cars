<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderDetailsRequest;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
      public function __construct(){
      $this->middleware(['auth']);
    }

  public function myOrders(){
    $user_id=Auth::user()->id;
    $orders=OrderDetail::select()->where('user_id',$user_id)
    ->paginate(PAGINATION_COUNT);
  return view('orders.index',compact('orders')); 
  }

	public function addOrder($product_id,$quantity){
		$product=Product::find($product_id);
		if(!$product) return abort(404);
		else if($product->quantity==0)
			return redirect()->route('products.index')->with([
				'error'=>'product is totally sold']);
		if($quantity>$product->quantity) 
			return redirect()->route('products.index')->with([
				'error'=>'remains of that product '.$product->quantity.
				' . if you want them confirm your order']);			
		$order=OrderDetail::create([
		  'product_id'=>$product_id,
		  'user_id'=>Auth::user()->id,
		  'quantity'=>$quantity,
		  'unitprice'=>$product->price,


		]);//Redirect to Product Page with Final Price

		return redirect()->route('products.show',$product_id)->
		with(['status'=>'you ordered '.$order->quantity.' of '.$product->name. 
			'with total cost = $'.$order->quantity*$product->price ]);
	}

	public function destroy($order_id){
		$order=OrderDetail::find($order_id);
		if(!$order) return abort(404);
		$order->delete();
		return redirect()->route('products.index',$product_id)->
		with(['success'=>'order deleted successfully' ]);

	}


}