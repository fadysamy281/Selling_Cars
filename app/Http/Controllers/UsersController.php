<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OrderDetailsRequest;
use App\Http\Requests\ProductRequest;
use App\Models\User;

class UsersController extends Controller
{
      public function __construct(){
      $this->middleware(['auth']);
    }
 /* public function productsIndex(){
    $products=Product::select('name','description','image','price')
      ->paginate(PAGINATION_COUNT);
      return view('products.index',compact('products'));
  }
  public function ordersIndex(){
    $orders=OrderDetail::paginate(PAGINATION_COUNT);
    return view('orders.index',compact('orders')); }
  public function usersIndex(){
    $users=User::paginate(PAGINATION_COUNT);
    return view('users.index',compact('users')); 
   }*/
   $user=Auth::user();
  public function profile(){
  $user=$this->user;
    return view('users.profile',compact('user'));
  }  
  public function edit(){
    return view('users.edit',compact('user'));
}
  public function update(UsersRequest $request){
    $user->update([
      'name'=>$request->name,
      'email'=>$request->email,
      'password'=>bcrypt($request->password)

    ]);  
  
return redirect()->route('users.profile');}

 





}
