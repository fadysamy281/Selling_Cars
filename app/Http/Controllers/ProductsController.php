<?php

namespace App\Http\Controllers;
use App\Traits\ImagesTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    use ImagesTrait;
    public function __construct(){
    	$this->middleware(['auth']);
    }
	public function create(){
		return view('products.create');
	}
 public function myProducts(){
  	$user_id=Auth::user()->id;
  	$products=Product::select()->where('id',$user_id)
  	->paginate(PAGINATION_COUNT);
	return view('products.index',compact('products')); 
  }

  public function buy(){
  	  	$user_id=Auth::user()->id;
  	$products=Product::select()->where('id','!==', $user_id)
  	->paginate(PAGINATION_COUNT);
	return view('products.index',compact('products')); 
  }
	public function store(ProductRequest $request){
		$file_name=Product::last()->id +1;
		$this->saveImage($file_name,$request->photo,'/images/products/');
		Product::create([
			'name'=>$request->name,
			'description'=>$request->description,
			'image'=>$file_name.'.'.$request->photo->getClientOriginalExtension(),
			'quantity'=>$request->quantity,
			'price'=>$request->price,
			'owner_id'=>Auth::user()->id,
			'category_id'=>$request->category_id//Array Naming
		]);
		return redirect()->route('products.index')->with([
			'success'=>'product created successfully']);
	}

	public function edit($id){//userid&&productid
		$product=Product::where('id',$id);
		if(!$product ||  $product->owner_id !== Auth::user()->id)
		 return abort(404);
		return view('products.edit')->with('product',$product);
	}
	public function update(ProductRequest $request,$id){

		$product=Product::find($id);
		if(!$product ||  $product->owner_id !== Auth::user()->id)
		 return abort(404);
		if($request->has('photo'))
			{ $image_path=public_path().'/images/products/'.$product->photo;
				File::delete($image_path);
				$this->saveImage($product->id,$request->photo,'/images/products/');
				$product->update(['photo'=>
					$product->id.'.'.$request->photo->getClientOriginalExtension()]);			
			}
		$product->update([
			'name'=>$request->name,
			'description'=>$request->description,
			'quantity'=>$request->quantity,
			'price'=>$request->price,
			'category_id'=>$request->category_id//Array Naming

		]);
			return redirect()->route('products.index')->with([
			'success'=>'product updated successfully']);

	}
	public function destroy($id){
		$product=Product::find($id);
		if(!$product ||  $product->owner_id !== Auth::user()->id)
		 return abort(404);
			$image_path=public_path().'/images/products/'.$product->photo;
			File::delete($image_path);		
			$product->delete();
			return redirect()->route('products.index')->with([
			'success'=>'product deleted successfully']);			


	}
	public function show($id){
	$product=Product::find($id);
		if(!$product ||  $product->owner_id !== Auth::user()->id)
		return abort(404);
		return view('products.show',compact('product'));
	}

}
