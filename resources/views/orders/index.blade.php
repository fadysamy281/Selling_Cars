@extends('layouts.app') @section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script type="text/javascript">
	function totalAmount(){
		var t = 0;
		$('.amount').each(function(i,e){
			var amt = $(this).val();
			t += amt;
		});
		$('.total').html(t);
	}
	$(function () {
		$('.getmoney').change(function(){
			var total = $('.total').html();
			var getmoney = $(this).val();
			var t = getmoney - total;
			$('.backmoney').val(t).toFixed(2);
		});
		$('.add').click(function () {
			var product = $('.product_id').html();
			var n = ($('.neworderbody tr').length - 0) + 1;
			var tr = '<tr><td class="no">' + n + '</td>' + '<td><select class="form-control product_id" name="product_id[]">' + product + '</select></td>' +
				'<td><input type="text" class="qty form-control" name="qty[]" 
            value="{{ old('qty[]') }}"></td>' +
				'<td><input type="text" class="price form-control" name="price[]" 
            value="{{ old('price[]') }}"></td>' +
				'<td><input type="text" class="dis form-control" name="dis[]"></td>' +
				'<td><input type="text" class="amount form-control" name="amount[]"></td>' +
				'<td><input type="button" class="btn btn-danger delete" value="x"></td></tr>';
			$('.neworderbody').append(tr);
		});
		$('.neworderbody').delegate('.delete', 'click', function () {
			$(this).parent().parent().remove();
			totalAmount();
		});
		$('.neworderbody').delegate('.product_id', 'change', function () {
			var tr = $(this).parent().parent();
			var price = tr.find('.product_id option:selected').attr('data-price');
			tr.find('.price').val(price);
			
			var qty = tr.find('.qty').val() - 0;
			var dis = tr.find('.dis').val() - 0;
			var price = tr.find('.price').val() - 0;
		
			var total = (qty * price) - ((qty * price * dis)/100);
			tr.find('.amount').val(total);
			totalAmount();
		});
		$('.neworderbody').delegate('.qty , .dis', 'keyup', function () {
			var tr = $(this).parent().parent();
			var qty = tr.find('.qty').val() - 0;
			var dis = tr.find('.dis').val() - 0;
			var price = tr.find('.price').val() - 0;
		
			var total = (qty * price) - ((qty * price * dis)/100);
			tr.find('.amount').val(total);
			totalAmount();
		});
		
        $('#hideshow').on('click', function(event) {  
			 $('#content').removeClass('hidden');
			$('#content').addClass('show'); 
             $('#content').toggle('show');
        });
    

		
	});
</script>

<style>
.hidden{
  display : none;  
}

.show{
  display : block !important;
}
select.form-control.product_id {
    width: 150px;
}
</style>
<div class="container">

	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">New Order</div>

				<div class="panel-body">
					<form class="form-horizontal" id="yoyo" role="form" method="POST" action="{{ url('/orders') }}">
                        @csrf
                        <table class="table table-striped">
							<tr>
								<td>
									Customer Name: <input type="text" class="form-control" name="name" value="{{ old('name') }}">
								</td>
								<td>
									Location: <input type="text" class="form-control" name="location" value="{{ old('location') }}">
								</td>
							</tr>
						</table>
						
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Product Name</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Discount</th>
									<th>Amount</th>
									<th>Delete</th>
									
								</tr>
							</thead>
							<tbody class="neworderbody">
								<tr>
									<td class="no">1</td>
									<td>
										<select class="form-control product_id" name="product_id[]">
											@forelse($products as $product)
											<option data-price="{{ $product->price }}" value="{{ $product->id }}">{{ $product->name}}</option>
											@endforelse
										</select>
									</td>
									<td>
										<input type="text" class="qty form-control" name="quantity[]" value="{{ old('quantity[]') }}">
									</td>
									<td>
										<input type="text" class="price form-control" name="price[]" value="{{ old('price[]') }}">
									</td>
									<td>
										<input type="text" class="dis form-control" name="dis[]">
									</td>
									<td>
										<input type="text" class="amount form-control" name="amount[]">
									</td>
									<td>
										<input type="button" class="btn btn-danger delete" value="x">
									</td>
								</tr>

							</tbody>
							
							<tfoot>
								<th colspan="6">Total:<b class="total">0</b></th>
							</tfoot>
														

						</table>	
						<input type="button" class="btn btn-lg btn-primary add" value="Add New Item">
						<hr>	

					<td>
						Get Money:
						<input type="text" class="getmoney form-control">
					</td>
					<td>
						Back Money:
					    <input type="text" class="backmoney form-control">
					</td>
					<hr>

					
					
				</div>
				
			</div>
		</div>
			<!--  Right -->

		 <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Actions</div>

					<div class="panel-body">
						<center><input type="submit" class="btn btn-default btn-lg" name="save" value="Place Order">  
						<button type="button" id='hideshow' class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
						  Generate Reciept
						</button>
						</center>
					</div>
            	</div>
		  </div>
		</form>
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Reciept</h4>
			  </div>
			  <div class="modal-body">
				<div class="panel-body " id="toPrint">

					<table class="table table-striped" >
						<thead>
							<tr>
								<th>ID</th>
								<th>Order Amount </th>
								<th>Order Qty</th>
								<th>Unit Price</th>
							</tr>
						</thead>
						<tbody>
							@forelse($orders as $order)
							<tr>
								<td>{{ $order->order_id }}</td>
								<td>{{ $order->amount }}</td>
								<td>{{ $order->quantity }}</td>
								<td>{{ $order->unitprice }}</td>
							
							</tr>
							@endforelse
						</tbody>
						
					</table>
				 <a href="javascript:void(0);" class="btn btn-primary" id="printPage">Print</a> 

				</div>
			</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			  </div>
			</div>
		  </div>
		</div>
		
	<!-- Row End -->
	
 <script lang='javascript'>
 $(document).ready(function(){
  $('#printPage').click(function(){
        var data = '<input type="button" value="Print this page" onClick="window.print()">';           
        data += '<div id="toPrint">';
        data += $('#toPrint').html();
        data += '</div>';

        myWindow=window.open('','','width=1200,height=1000');
        myWindow.innerWidth = screen.width;
        myWindow.innerHeight = screen.height;
        myWindow.screenX = 0;
        myWindow.screenY = 0;
        myWindow.document.write(data);
        myWindow.focus();
    });
 });
 </script>
</div>

@endsection