<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarsController;


/*
|----------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//  Route::get('/','UsersController@buy')->name('products.buy');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
define('PAGINATION_COUNT',5);
Auth::routes(['verify'=>true]);
	
    Route::get('/',		[CarsController::class, 'offeredCars'])->name('cars.offeredCars');
	Route::get('/home', [HomeController::class, 'index'])->name('home');

    ######################### Begin Cars Routes ########################
Route::prefix('cars')->name('cars.')->group(function(){
	  Route::get('index'     ,[CarsController::class, 'myCars'])->name('myCars');
	  Route::get('create'    ,[CarsController::class, 'create'])->name('create');
	  Route::post('store'    ,[CarsController::class, 'store'])->name('store');
	  Route::get('{id}/edit' ,[CarsController::class, 'edit'])->name('edit');
	  Route::post('{id}/edit',[CarsController::class, 'update'])->name('update');
	  Route::post('destroy'  ,[CarsController::class, 'destroy'])->name('destroy');
	  Route::post('buy'  	 ,[CarsController::class, 'buy'])->name('buy');
});

    ######################### End Cars Routes ########################

    ######################### Begin Users Routes ########################

	Route::prefix('users')->name('users.')->group(function(){

 
	Route::get('profile',[UsersController::class, 'profile'])->name('profile');
	Route::get('edit'   ,[UsersController::class, 'edit'])->name('edit');
	Route::post('edit'  ,[UsersController::class, 'update'])->name('update');
});
    ######################### End Users Routes ########################
