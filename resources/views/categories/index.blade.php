@extends('layouts.app')
@section('content')
	
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">All Categories</div>

                <div class="panel-body">
                   
                    <table class="table table-striped">
							<thead>
							  <tr>
								<th>ID</th>
								<th>Category Name</th>
								<th>Category Code</th>
								<th>Image</th>
								<th>Edit</th>
								<th>Delete</th>
							  </tr>
							</thead>
							<tbody>
						  	  @foreach($categories as $category)
								  <tr>
								    <td>{{ $category->id }}</td>
									<td>{{ $category->name }}</td>
									
									<td>
									       	
										//Add Links 
												<a  href=""class="btn btn-primary">Edit</a>
								
									</td>
									<td>

												<a href="" class="btn btn-danger">Delete</button>

                                    </td>
								  </tr>
							  @endforeach
							  <a class="btn btn-default" href="">Add New Category</a>
							</tbody>
						  </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection