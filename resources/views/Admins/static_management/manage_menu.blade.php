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
            <h1 class="m-0 text-dark"style="text-decoration: bold;">Menu Management</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item">
                  <a href=" # "></a>
               </li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
     
	  <br />
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
   <div class="container-fluid">
    
      <table class="table table-bordered table-striped">
         <tr>
            <th>Sr.No</th>
            <th>Title</th>
            
         </tr>
         @foreach($menus as $menu)
         <tr>
            <td>{{$i++}}</td>
            <td>{{$menu->title}}</td>
            
         </tr>
         @endforeach
      </table>
   </div>
</section>
</section>
		
		
	</div>
</div>

</section>
@endsection