<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
class CategoriesController extends Controller
{
      public function __construct(){
      $this->middleware(['auth','isAdmin']);
    }
    public function index(){
		$categories=Category::select('name')
			->paginate(PAGINATION_COUNT);
			return view('categories.index',compact('categories'));
	}
	public function create(){
		return view('categories.create');
	}

	public function store(CategoryRequest $request){
		Category::create([
			'name'=>$request->name,
			
		]);
		return redirect()->route('categories.index')->with([
			'success'=>'category created successfully']);
	}
		public function edit($id){
		$category=Category::find($id);
		if(!$category) return abort(404);
		return view('categories.edit')->with('category',$category);
	}
	public function update(CategoryRequest $request,$id){
		$category=Category::find($id);
		if(!$category) return abort(404);
			
		$category->update([
			'name'=>$request->name,

		]);
			return redirect()->route('categories.index')->with([
			'success'=>'category updated successfully']);

	}

	public function destroy(CategoryRequest $request,$id){
		$category=Category::find($id);
		if(!$category) return abort(404);
			
			$category->delete();
			return redirect()->route('categories.index')->with([
			'success'=>'category deleted successfully']);

	}





}
