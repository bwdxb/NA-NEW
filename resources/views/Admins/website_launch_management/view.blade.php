@extends('layouts.master')

@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Show User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ url('/admin')}} "></a></li>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<div class="container" style="width:65%; height:30%; border:7px solid #aaa; margin:5%; ">
<section class="content text-center">
      <div class="container-fluid" style="margin-left: 11%;">
        
          <div class="form-group text-center">
            <div class="row">
             <label class="col-sm-3">Category Name</label>
            <div class="col-sm-3" style="margin-left: 20%;">{{isset($banner->getCategory->name)?$banner->getCategory->name:''}}</div>
            </div>
             <div class="row">
             <label class="col-sm-3">Name</label>
            <div class="col-sm-3" style="margin-left: 20%;">{{$banner->name}}</div>
            </div>
            
          <div class="row">
             <label class="col-sm-3">Sequence Number</label>
            <div class="col-sm-3" style="margin-left: 20%;">{{$banner->sequence_number}}</div>
            </div>

        <div class="row">
             <label class="col-sm-3">Image:</label>
             <td><img src="{{asset('image/banner//'.$banner->image)}}" style="margin-left: 25%;" height="100px" width="100px"></td>
          
           </div>
           

 </div>
        
</div>
</section> 

</div>

           <div class="row">
             
            <div class="col-sm-3" style="margin-left: 32%;"> 
              <a href="{{url('/marketbanner')}}" class="btn btn-info btn-lg ">Back</a>
             </div>
            
          </div>


@endsection