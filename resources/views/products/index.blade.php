@extends('layouts.app')
@section('content')
	
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Products</div>

                <div class="panel-body">
                   
                    <table class="table table-striped">
							<thead>
							  <tr>
								<th>ID</th>
								<th>Product Name</th>
								<th>Product Description</th>
								<th>Product Price</th>
								<th>Quantity</th>
								<th>Edit</th>
								<th>Delete</th>
							  </tr>
							</thead>
							<tbody>
						  	  @foreach($products as $product)
								  <tr>
								    <td>{{ $product->id }}</td>
									<td>{{ $product->name }}</td>
									<td>{{ $product->desc }}</td>
									<td>{{ $product->price }}</td>
									<td>{{ $product->quantity }}</td>
									<td><img src="/images/products/{{$product->photo}}"></td>
									<td>
									       	
										//Add Links 
												<a  href=""class="btn btn-primary">Edit</a>
								
									</td>
									<td>

												<a href="" class="btn btn-danger">Delete</button>

                                    </td>
								  </tr>
							  @endforeach
							</tbody>
						  </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection