
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
            <h1 class="m-0 text-dark" >Show User</h1>
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<section class="content">
   <div class="container-fluid">
   
     
       
         <div class="form-group">
            <div class="row">
               <label class="col-sm-3">Order ID</label>
                <div class="col-sm-6"><input type="text" name="first_name" class="form-control" value="{{$order->order_id}}"  disabled="disabled">
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			<br>
			<div class="row">
               <label class="col-sm-3">Order Amount</label>
                <div class="col-sm-6"><input type="text" name="cost" class="form-control" value="{{$order->cost}}"  disabled="disabled">
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-3">Order Creation Date/Time</label>
                <div class="col-sm-6"><input type="text" name="created_at" class="form-control" value="{{date('m/d/Y h:m A',strtotime($order->created_at))}}"  disabled="disabled">
				
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-3">Order Delivery Date</label>
                <div class="col-sm-6"><input type="text" name="delivery_at" class="form-control" value="{{$order->delivery_at}}"  disabled="disabled">
				
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-3">Customer Name</label>
                <div class="col-sm-6"><input type="text" name="user_name" class="form-control" value="{{$order->userData->user_name}}"  disabled="disabled">
				
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			</br>
			<div class="row">
               <label class="col-sm-3">Customer Email ID</label>
                <div class="col-sm-6"><input type="text" name="email"class="form-control" value="{{$order->userData->email}}"  disabled="disabled">
				
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-3">Customer Phone</label>
                <div class="col-sm-6"><input type="text" name="mobile" class="form-control" value="{{$order->userData->mobile}}"  disabled="disabled">
				
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-3">Delivery Address</label>
                <div class="col-sm-6"><input type="text" name="address" class="form-control" value="{{$order->userData->address}}"  disabled="disabled">
				
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			<br>
			
			<div class="row">
               <label class="col-sm-3">Current Status</label>
                <div class="col-sm-6"><input type="text" name="status" class="form-control" value="{{$order->status}}"  disabled="disabled">
				
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			</br>
			<div class="row">
               <label class="col-sm-3">Payment Status</label>
                <div class="col-sm-6"><input type="text" name="status" class="form-control" value="{{@$order->transactionData->transationDetail->status}}"  disabled="disabled">
				
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-3">Payment Mode</label>
                <div class="col-sm-6"><input type="text" name="payment_mode" class="form-control" value="{{@$order->transactionData->transationDetail->payment_mode}}"  disabled="disabled">
				
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-3">Coupans If any</label>
                <div class="col-sm-6"><input type="text" name="coupan" class="form-control" value=""  disabled="disabled">
				
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			<br>
		  <div class="row">
		  <table class="table table-borderd table-striped">
		  <tr><td>Product ID</td><td>{{$order->productData->Product_ID}}</td></tr>
		  <tr><td>Product Name</td><td>{{$order->productData->productname}}</td></tr>
		  <tr><td>Product Category</td><td>{{$order->productData->categoryDetails->name }}</td></tr>
		  <tr><td>Product Sub-Category</td><td>{{$order->productData->subCategoryDetails->subcategory_name  }}</td></tr>
		  <tr><td>Product Brand</td><td>{{@$order->productData->getBrand->brand_name  }}</td></tr>
		  <tr><td>Product Color</td><td>{{@$order->productData->colorDetails->name  }}</td></tr>
		  <tr><td>Product Size</td><td>{{$order->productData->size  }}</td></tr>
		  </table>
		  </div>
        
              </div>
			
			  
			  <br/>
             

            <div class="form-group text-center">
               <a href="{{url('/order')}}" class="btn btn-info ">Back</a>
            </div>
         </div>
      
   </div>
 </section>


</div>
           
</section>
		
		
	</div>
</div>  
 </section>

@endsection