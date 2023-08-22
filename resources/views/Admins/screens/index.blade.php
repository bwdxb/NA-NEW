@extends('layouts.master')

@section('content')
<section class="wrapper"> 
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
		<div class="content-header">
		  <div class="container-fluid">
			<div class="row mb-2">
			  <div class="col-sm-6 mt-4">
				<h1 class="m-0 text-dark">Screen Management</h1>
			  </div><!-- /.col -->
			 
			</div><!-- /.row -->
		  </div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
@if(Session::has('message'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
          </button>
      <strong>{{ session('message') }}</strong>
      </div>
    @endif 
    @if(Session::has('error'))
      <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
          </button>
      <strong>{{ session('error') }}</strong>
      </div>
    @endif 


    <form method="get" action="">
      <div class="d-block">
	    <div class="row">
        <div class="col-lg-3" style="margin:4px">
			<input class="form-control " value="{{Request::get('name')}}" name="name" type="text" placeholder="Search by name" aria-label="Search">  
          </div>
		  <div class="col-lg-1 ">
		  <button class="btn btn-primary " type="submit" style="margin-top:4px;" >Search </button>
		  </div>
		  </div>
        </div>
      </form>
      <div class="float-sm-right mt-4 mb-3">
        <a href="{{ route('screen.create')}}" class="btn btn-primary " style="margin-bottom:5px;">Add Screen</a>
      </div>
	  
      <table class="table table-bordered table-striped">
        <tr>
          <th>S.No</th>
          <th>Page URL</th>
		  <th>Label</th>
          <th>Page Code</th>
		  <th>Module</th>

        </tr>
              
             @foreach($screens as $key => $screen)     
        <tr>

          <td>{{($screens->perPage() * ($screens->currentPage() - 1))+ ($key+1)}}</td>
        	
         <td>{{$screen->page_url}}</td>
		 <td>{{$screen->label}}</td>
          <td>{{$screen->page_code}}</td>
		   <td>{{$screen->module}}</td>
        
        
		  
          </tr>
           @endforeach
          

      </table>
      </div>

   {{ $screens->links() }} 
    </section>
	</section>
		
		
	</div>
</div>
        
</section>
  @endsection