<?php
?>
@extends('layouts.master')

@section('content')
<section class="wrapper"> 
<div class="row">
	<div class="col-sm-12">
		<section class="panel"> 
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Order Management</h1>
      </div>
     
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <!-- <a href="/home">Dashboard</a> -->
          </li>
        </ol>
      </div>
    
    </div>
   
  </div>
  
</div>
<section class="content">
  <div class="container-fluid">
  
  <div class="panel-body">
	<form action="" id="categories_form">
		<div class="col-lg-4 col-sm-6">
		  <div class="form-group">                                    
				<div class="col-md-12 col-sm-6 col-xs-11">
					<input class="form-control form-control-navbar " value="{{Request::get('order_id')}}" name="order_id" placeholder="Search by Order Id" aria-label="Search">
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6">
		  <div class="form-group">                                    
				<div class="col-md-12 col-sm-6 col-xs-11">
				
					<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{\Carbon\Carbon::now()}}"  class="input-append date dpYears">
						<input type="text" autocomplete="off" name="created_from" class="form-control" value="{{Request::get('created_from')}}"   placeholder="Order Creation Date From">
						<span class="input-group-btn add-on">
							  <button class="btn btn-primary date-set" type="button">
								<i class="fa fa-calendar"></i></button>
							</span>
					</div>
					
				</div>
			</div>
		</div>    
		<div class="col-md-4 col-sm-6">
		  <div class="form-group">                                    
				<div class="col-md-12 col-sm-6 col-xs-11">
					<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{\Carbon\Carbon::now()}}"  class="input-append date dpYears">
						<input type="text" autocomplete="off" name="created_to" class="form-control" value="{{Request::get('created_to')}}"  placeholder="Order Creation Date To">
						<span class="input-group-btn add-on">
							  <button class="btn btn-primary date-set" type="button">
								<i class="fa fa-calendar"></i></button>
							</span>
					</div>
					
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="col-lg-4 col-sm-6">
		  <div class="form-group">                                    
				<div class="col-md-12 col-sm-6 col-xs-11">
					<input class="form-control form-control-navbar " value="{{Request::get('user_name')}}" name="user_name" placeholder="Search by Customer name" aria-label="Search">
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6">
		  <div class="form-group">                                    
				<div class="col-md-12 col-sm-6 col-xs-11">
					<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{\Carbon\Carbon::now()}}"  class="input-append date dpYears">
						<input type="text" autocomplete="off" name="delivery_from" class="form-control" value="{{Request::get('delivery_from')}}" size="16" placeholder="Order Delivery Date From">
						<span class="input-group-btn add-on">
							  <button class="btn btn-primary date-set" type="button">
								<i class="fa fa-calendar"></i></button>
							</span>
					</div>
					
				</div>
			</div>
		</div>    
		<div class="col-md-4 col-sm-6">
		  <div class="form-group">                                    
				<div class="col-md-12 col-sm-6 col-xs-11">
					<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{\Carbon\Carbon::now()}}"  class="input-append date dpYears">
						<input type="text" autocomplete="off" name="delivery_to" class="form-control" value="{{Request::get('delivery_to')}}" size="16" placeholder="Order Delivery Date From">
						<span class="input-group-btn add-on">
							  <button class="btn btn-primary date-set" type="button">
								<i class="fa fa-calendar"></i></button>
							</span>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="clearfix"></div>
		<div class="col-lg-4 col-sm-6">
		  <div class="form-group">                                    
				<div class="col-md-12 col-sm-6 col-xs-11">
					<input class="form-control form-control-navbar " value="{{Request::get('mobile')}}" name="mobile" placeholder="Search by Customer Phone Number" aria-label="Search">
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6">
		  <div class="form-group">                                    
				<div class="col-md-12 col-sm-6 col-xs-11">
					<input class="form-control form-control-navbar " value="{{Request::get('email')}}" name="email" placeholder="Search by Customer Email Id" aria-label="Search">
				</div>
			</div>
		</div>    
		<div class="col-md-4 col-sm-6">
		  <div class="form-group">                                    
				<div class="col-md-12 col-sm-6 col-xs-11">
					<select name="status" class="form-control">
				<option value="">Select Status</option>
				
				<option value="1" @if(Request::get('status') == '1') selected  @endif>Pending</option>
				<option value="5" @if(Request::get('status') == '5') selected  @endif>Deliverd</option>
				</select>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="form-group mt-4">
				<div class="col-lg-offset-5 col-lg-6">
					<a href="{{route('order.index')}}" id="reset_filter" class="btn btn-danger">Reset</a>
					<button type="submit" id="category_filter_search" class="btn btn-primary">Search</button>
				</div>
			</div>
		</form>
     </div>
 </div>
</section>
      <br><br>
    <div class="wrapper" style="overflow-x: scroll;">
    	<table  class="table table-borderd table-striped">
   
      <tr>
        <th>Id</th>
        <th>Order Id</th>
        <th>Order Amount</th>
        <th>Order Creation Date/Time</th>
        <th>Order Delivery Date</th>
        <th>Customer Name</th>
        <th>Customer Email</th>
		<th>Customer Phone</th>
        <th>Delivery Address</th>
		<th>Current Status</th>
        <th>Payment Status</th>
        <th>Payment Mode</th>
		<th>Coupans Apply If any</th>
        <th>Action</th>
      </tr>
      @forelse($orders as $key => $order)
      <tr>
      <td>{{ $key+1}}</td>
	  <td>{{ $order->order_id}}</td>
	  <td>{{$order->cost}}</td> 
      <td>{{\Carbon\Carbon::parse($order->created_at)->format('d-m-Y')}}</td> 
	  <td>{{\Carbon\Carbon::parse($order->delivery_date)->format('d-m-Y')}}</td> 
      <td>{{$order->userData->user_name}}</td>
	  <td>{{$order->userData->email}}</td>
	  <td>{{$order->userData->mobile}}</td>
	  <td>{{$order->userData->address}}</td>
	 
	  <td> @if($order->status ==1) Pending
				@elseif($order->status ==2) Intransit 
				@elseif($order->status ==3) Shipped
				@elseif($order->status ==4) Outfordelivery
				@elseif($order->status ==5) Delivered
				@elseif($order->status ==6) Cancelled
				@elseif($order->status ==7) Failed
				@elseif($order->status ==8) Declined
				@elseif($order->status ==9) Returned
				@elseif($order->status ==10) Exchange

			@endif
	 </td> 
			   
	   <td> 
	   
	   @if(@$order->transactionData->transationDetail->status == '1')
              {{'Done'}}
              @else
              {{'Pending'}}
              @endif </td>
	<td>{{@$order->transactionData->transationDetail->payment_mode}}</td> 
      <td>&nbsp;</td>
        
      <td>
           <a href="{{ route('order.show',$order->id)}}" class="btn btn-success" title="Edit"><i class="fa fa-eye" aria-hidden="true"></i></a>
              
           </td>

      </tr>
     @empty
          {{'No Data Found'}}
              @endforelse
    </table>
    </div>
  </div>
 {{ $orders->links() }} 
</section>
</section>
		
		
	</div>
</div>

</section>
@endsection
@section('script')
    <script>


var public_url = $('meta[name="base_url"]').attr('content');


 function deleteConfirmation(id) {
    swal({
         title: "Are you sure?",
         text: "Are you sure you want to delete the Order?",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#069edb",
         confirmButtonText: "Yes, delete it!",
         closeOnConfirm: false
         }, function() {
         
        
         $.ajax({
                type: 'get',
                url: public_url + "/order/delete/" +id,
                success: function(data) {
                swal({
                     title: " Success!",
                     text: "Order deleted successfully!",
                     type: "success",
                     confirmButtonColor: "#069edb",
                     //timer: 3000
                     },
                     function() {
                     window.location.href = public_url + '/order';
                     });
                }
                });
         });
}
  </script>
   
  @endsection
