@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Product</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/product', $productToUpdate->id) }}">
                        @csrf
						 

                        <div class="form-group @error('name') ? ' has-error' : '' @enderror">
                            <label class="col-md-4 control-label">Product Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}">

                            </div>
                        </div>

                        <div class="form-group @error('description') ? ' has-error' : '' @enderror">
                            <label class="col-md-4 control-label">Product Description</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="description" 
                                value="{{ $product->description }}">
                               
                            </div>
                        </div>

                        <div class="form-group @error('price') ? ' has-error' : '' @enderror">
                            <label class="col-md-4 control-label">Price</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="price" value="{{ $product->price }}">

                               
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Quantity</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="quantity" value="{{ $product->quantity }}">

                            </div>
                        </div>
                        <div class="form-group @error('photo') ? ' has-error' : ''@enderror ">
                            <label class="col-md-4 control-label">Product Image</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" name="photo">
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Update Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
