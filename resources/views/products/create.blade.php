@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Product</div>
                <div class="panel-body">
                    <form class="form-horizontal"  method="POST" action="{{route('products.store')}}">
                        @csrf
                        @if(session()->has('success'))
                        <div class="alert alert-success">session()->get()</div>
                        @endif
                        <div class="form-group @error('name') ? ' has-error' : '' @enderror">
                            <label class="col-md-4 control-label">Product Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                            </div>
                            @error('name') 
                              <div class="alert alert-danger">$message</div>
                            @enderror  
                        </div>

                        <div class="form-group @error('description') ? ' has-error' : ''@enderror ">
                            <label class="col-md-4 control-label">Product Description</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                               
                            </div>
                        </div>

                        <div class="form-group @error('photo') ? ' has-error' : ''@enderror ">
                            <label class="col-md-4 control-label">Product Image</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" name="photo">
                               
                            </div>
                        </div>
                        <div class="form-group @error('price') ? ' has-error' : '' @enderror">
                            <label class="col-md-4 control-label">Price</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="price">

                               
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Quantity</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="quantity">

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Add Producct
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
