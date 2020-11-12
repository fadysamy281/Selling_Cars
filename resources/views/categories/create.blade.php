@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Category</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/category') }}">
                        @csrf

                        <div class="form-group @error('name') ? ' has-error' : '' @enderror">
                            <label class="col-md-4 control-label">Category Name</label>
								<div class="col-md-6">
                               		 <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            	</div>
                        </div>

                        
						
                                             <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Add Category
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
