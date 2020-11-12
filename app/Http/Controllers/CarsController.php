<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Car;
use App\Traits\ImagesTrait;
use App\Http\Requests\CarsRequest;
use App\Traits\OrdersTrait;
class CarsController extends Controller
{
   protected $currentUser=Auth::user();
   protected $path='/images/cars/';
    use ImagesTrait , OrdersTrait;
    public function __construct(){
    	$this->middleware(['auth']);
    }
	public function create(){
		return view('cars.create');
	}
 	public function myCars(){
  	$user_id=$this->currentUser->id;
  	$cars=Car::select()->where('id',$user_id)
  	->paginate(PAGINATION_COUNT);
	return view('cars.index',compact('cars')); 
    }
    	public function offeredCars(){
  	$user_id=$this->currentUser->id;
  	$cars=Car::select()->where('id','!==',$user_id)
  	->paginate(PAGINATION_COUNT);
	return view('cars.index',compact('cars')); 
    }
	public function store(CarsRequest $request){



		$car=Car::where(['name'=>$request->name,
			'color'=>$request->color,
			'owner_id'=>$currentUser]);
		if(!$car){
		$file_name=Car::last()->id +1;


		$this->saveImage($file_name,$request->photo,$this->path);
		Car::create([
			'name'=>$request->name,//Array Naming
			'description'=>$request->description,
			'photo'=>$file_name.'.'.$request->photo->getClientOriginalExtension(),
			'quantity'=>$request->quantity,
			'price'=>$request->price,
			'color'=>$request->color,
			'owner_id'=>$this->currentUser->id,
		]);}
		else {
			$car->update(['quantity'=>
				$this->quantity+$request->quantity]);}

		return redirect()->route('cars.myCars')->with([
			'success'=>"all car's data created successfully"]);}

	public function real($id)
	{		$car=Car::find($id);
		return (!$car||$car->owner_id!==$this->currentUser->id)?
		  abort(404): $car;
}
	public function edit($id){//userid&&productid
		$car=$this->real($id);
		return view('cars.edit')->with('car',$car);
	}
	public function update(CarsRequest $request,$id){

		$car=$this->real($id);
		if($request->has('photo'))
			{ $image_path=public_path().$this->path.$car->photo;
				File::delete($image_path);
				$this->saveImage($car->id,$request->photo,$this->path);
				$car->update(['photo'=>
					$car->id.'.'.$request->photo->getClientOriginalExtension()]);			
			}
		$car->update([
			'name'=>$request->name,//Array Naming
			'description'=>$request->description,
			'quantity'=>$request->quantity,
			'price'=>$request->price,

		]);
			return redirect()->route('cars.myCars')->with([
			'success'=>"all car's data updated successfully"]);

	}
	public function destroy($id){
		$car=$this->real($id);
		
			$image_path=public_path().$this->path.$car->photo;
			File::delete($image_path);		
			$this->deleteOrders($car->id);
			$car->delete();
			return redirect()->route('cars.myCars')->with([
			'success'=>"all car's data deleted successfully"]);			
	}

	public function buy($car_id,$quantity){
		$car=$this->real($car_id);
		if($quantity>$car->quantity)
			return redirect()->route('cars.offeredCars')->with([
				'error'=>'that car remains of it '.$car->quantity.' cars that seller have.']);
			$this->addOrder($car,$quantity,$this->currentUser);
			return redirect()->route('cars.offeredCars')->with([
				'success'=>'orders done! you bought '.$quantity.'cars.']);



	}
	
	  







}
