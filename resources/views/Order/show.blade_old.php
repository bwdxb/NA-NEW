@extends('layouts.master')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark" >Show Order</h1>
      </div>
      <!-- /.col -->
      <div class="col-sm-6">
      
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<div class="container" style="width:65%;  margin:10%; ">
<section class="content text-center">
      <div class="container-fluid" style="margin-left: 11%;">
        
       <div class="form-group text-center">
            <div class="row">
             <label class="col-sm-3">Product Name:</label>
            <div class="col-sm-3" style="margin-left: 20%;">
                <td>{{$order->name}}</td>
              </div>
            </div>

            <div class="row">
             <label class="col-sm-3">Product Description:</label>
            <div class="col-sm-3 " style="margin-left: 20%;">
              <td>{{$order->product_description}}</td>
            </div>
            
            </div>


             <div class="row">
             <label class="col-sm-3">Category Name:</label>
             <?php
             $all_category_info=DB::table('orders')->get();
               foreach ($all_category_info as $order) {?> 
              <div class="col-sm-3" style="margin-left: 20%;" value="{{$order->category_id}}">{{$order->category_name}}</div>
              <?php } ?>
            
          
          </div>

             <div class="row">
             <label class="col-sm-3">Subcategory Name :</label>
            <div class="col-sm-3" style="margin-left: 20%;">{{$order->subcategory}}</div>
          
          </div>

          <div class="row">
             <label class="col-sm-3">Seller Name :</label>
            <div class="col-sm-3" style="margin-left: 20%;">{{$order->subcategory}}</div>
          
          </div>

          <div class="row">
             <label class="col-sm-3">Order Date:</label>
            <div class="col-sm-3" style="margin-left: 20%;">{{$order->uploaddate}}</div>
           
           </div>
           
           <div class="row">
             <label class="col-sm-3">Delivery Date:</label>
            <div class="col-sm-3" style="margin-left: 20%;">{{$order->uploaddate}}</div>
           
           </div>
          
           <div class="row">
             <label class="col-sm-3"> Total available quantity:</label>
            <div class="col-sm-3" style="margin-left: 20%;">{{$order->quantity}}</div>
            </div>
            
            <div class="row">
            <label class="col-sm-3">Cost:</label>
            <div class="col-sm-3" style="margin-left: 20%;">{{$order->cost}}</div>
           
           </div>
          
           <div class="row">
             <label class="col-sm-3">Status:</label>
            <div class="col-sm-3" style="margin-left: 20%;">{{$order->status}}</div>
           
           </div>
            
            
           
           <div class="row">
             <label class="col-sm-3">Address</label>
            <div class="col-sm-3" style="margin-left: 20%;">{{$order->address}}</div>
           
           </div>
           
           <div class="row">
             <label class="col-sm-3">Country:</label>
            <div class="col-sm-3" style="margin-left: 20%;">{{$order->country}}</div>
           
           </div>
           
           <div class="row">
             <label class="col-sm-3">State:</label>
            <div class="col-sm-3" style="margin-left: 20%;">{{$order->state}}</div>
           
           </div>
           
           
           </div>
            
          </div>
        </div>
 </section> 
    <div class="row">
      <div class="col-sm-3" style="margin-left: 40%;"> 
        <a href="{{url('/order')}}" class="btn btn-info btn-lg ">Back</a>
      </div>
    </div>



@endsection