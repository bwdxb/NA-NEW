@php
use app\Http\helper\Helper as Helper;
$news_category = Helper::getNewsCategoryAll();
@endphp
@extends('layouts.master')

@section('content')
 <!-- Content Header (Page header) -->
 <style type="text/css">
  /* tr,th,td{
    min-width: 150px;
  } */
  td.ellipse-text {
      max-width: 150px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
  }
  td.img img{
    max-height:70px;
  }
</style>  
<section class="wrapper">
<!-- page start-->

<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 mt-4">
            <h1 class="m-0 text-dark">News Management</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   <div class="content">

   <div class="container-fluid">
      <form method="get" action="">
      <div class="d-block">
	    <div class="row">
      <div class="col col-lg">
      <select name="lang" class="form-control" autocomplete="off" >
				<option value="">{{__('Select Language')}}</option>
				<option value="English" @if('English' ==Request::get('lang')) selected="selected" @endif>{{__('English')}}</option>
				<option value="Arabic" @if('Arabic' ==Request::get('lang')) selected="selected" @endif>{{__('Arabic')}}</option>
			</select>
</div>
      <div class="col col-lg">
			<div class="input-group">
				<select name="cat_id" id="cat_id" class="form-control">
					<option value="">{{__('Select Category')}}</option>
						@foreach($news_category as $key=>$category) 
						<option value="{{$category->id}}" @if($category->id == Request::get('cat_id')) selected @endif>
						@if(app()->getLocale() == 'en')	
							{{$category->name}} 
						@else
							{{$category->name_ar}}
						@endif
					</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col col-lg">
			<input type="text"  autocomplete="off" id="title" class="form-control" placeholder="{{__('Search By Keyword')}}" value="{{Request::get('title')}}" name="title"> 
		</div>

		<div class="col col-lg">

			<select name="year" class="form-control" autocomplete="off">
				<option value="">{{__('Year')}}</option>
				<?php  $currentYear = date('Y'); 
				foreach (range(2010, $currentYear) as $value) {?>
					<option value="<?php echo $value?>" @if($value ==Request::get('year')) selected="selected" @endif><?php echo $value?></option>   

				<?php }
				?>

			</select>
		</div>

		<div class="col col-lg">

			<select name="month" class="form-control" autocomplete="off">
				<option value="">{{__('Month')}}</option>
				<?php
				
				for ($i = 0; $i < 12; $i++) {
					$time = strtotime(sprintf('%d months', $i),strtotime("01/01/2021"));   
					$label = date('F', $time);   
					$value = date('n', $time);?>

					<option  value='<?php echo $value?>' @if($value ==Request::get('month')) selected="selected" @endif>{{__($label)}}</option>

				<?php }?>
			</select>
		</div>


	
		<div class="col col-lg">

			<select name="sort_by" class="form-control" autocomplete="off" >
				<option value="">{{__('Sort By')}}</option>
				<option value="desc" @if('desc' ==Request::get('sort_by')) selected="selected" @endif>{{__('Newest')}}</option>
				<option value="asc" @if('asc' ==Request::get('sort_by')) selected="selected" @endif>{{__('Oldest')}}</option>

			</select>
		</div>
     
		<div class="col col-lg">
			<button class="btn btn-primary " type="submit">{{__('Filter')}} </button>
		</div>
		  	
		  </div>
        </div>
      </form>
	   <div class="float-sm-right mt-4 mb-3">
        <a href="{{ route('news.create')}}" class="btn btn-primary " style="margin-bottom:5px;">Create News</a>
      </div>
	  @if(Session::has('message'))
		  <div class="alert {{ Session::get('alert-class', 'alert-success') }}" style="margin-top: 15px;" >
			<div style="display:inline-block" id="">
			  {{ Session::get('message') }}
			</div>
		  </div>
		@endif 
		@if(Session::has('error'))
		  <div class="alert {{ Session::get('alert-class', 'alert-danger') }}" style="margin-top: 15px;" >
			<div style="display:inline-block" id="">
			  {{ Session::get('error') }}
			</div>
		  </div>
		@endif 
	  <table class="table table-bordered table-striped mt-5">
        <tr>
		  <th style="width:50px;">S.no.</th>
      <th>Language</th>
		  <th>Category</th>
		  <th>Title</th>
		  <th>Date</th>
		  <th> Image</th>
		  <th>Action</th>
		</tr>
              
            @foreach($news as $key=>$new)
                               
				<tr>
				  <td style="width:50px;">{{($news->perPage() * ($news->currentPage() - 1))+ ($key+1)}}</td>
          <td>{{$new->lang}}</td>
				  <td>{{$new->category}}</td>
				  <td class="ellipse-text">{{$new->title}}</td>
				 <td>{{date('d M Y', strtotime($new->news_date))}}</td>
				  
				  <td class="img">
				  @php
				  $image = json_decode($new->image);
				  @endphp
				  @if($new->cover_img)

				  <img src="{{url('public/uploads/news/'.$new->cover_img)}}">
          @elseif(!empty($image))
				  <img src="{{url('public/uploads/news/'.$image[0])}}">
				  @endif
				  </td>
				  <!-- <td class="img">
				  @php
				  $image = json_decode($new->image);
				  @endphp
				  @if(!empty($image))
				  <img src="{{url('public/uploads/news/'.$image[0])}}">
				  @endif
				  </td> -->
				       
				  <td>
          <a href="{{route('news.history',$new->id)}}" class="btn btn-warning" title="History"><i class="text-white fas fa-history" aria-hidden="true"></i></a>

				  <a href="{{ route('news.edit',$new->id)}}" class="btn btn-info" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
				  @if($new->status == '1')
             <a  onclick="statefunction('{{$new->id}}')" class="btn btn-success btn-successuser" title="Block" style="color:white;"><i class="text-white fa fa-unlock" aria-hidden="true" ></i></a>
              @else
              <a  onclick="statefunction('{{$new->id}}')" class="btn btn-danger btn-successuser" title="Unblock" style="color:white;"><i class="text-white fa fa-lock" aria-hidden="true" ></i></a>
                @endif
				  <a onclick="deleteConfirmation('{{$new->id}}')" class="btn btn-danger" title="Delete"><i class="text-white fa fa-ban fa-trash" aria-hidden="true" ></i></a>

					 </td>

				</tr>
             @endforeach
      </table>

 </div> 
		 
   </div>
   {{ $news->links() }} 
</div>
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
         text: "Are you sure ,you want to DELETE ?",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#069edb",
         confirmButtonText: "Yes, delete it!",
         closeOnConfirm: false,
         buttons: true,
  dangerMode: true,
         }).then((willDelete)=> {
         
        if(willDelete){
          $.ajax({
                type: 'get',
                data: {
                '_method': 'get'
                },
                url: "/admin/news/delete/" +id,
                success: function(data) {
                  swal({
                      title: " Success!",
                      text: "News deleted successfully!",
                      type: "success",
                      confirmButtonColor: "#069edb",
                      //timer: 3000
                      }).then(() =>{
                      window.location.replace("{{url('/admin/news')}}");
                      });
                  }
                });
        }
        
         });
  }
  </script> 


   <script>
  function statefunction(id){
        swal({
          title: "Are you sure?",
          text: "You want to perform this action!",
          type: "warning",
          showCancelButton: true,
          cancelButtonClass: 'btn-danger',
          confirmButtonText: 'Yes,perform it',
          cancelButtonText: "Cancel",
          closeOnConfirm: false,
          buttons: true,
          dangerMode: true,
          closeOnCancel: true,
        }).then((isConfirm) =>{
          if(isConfirm){
           jQuery.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
          });
          jQuery.ajax({
            type: 'get',
            url:  "{{url('/admin/news/status')}}/"+id,
            success: function(data) {
                if(data == 1){
                  var status_banner = 'unblocked';
                }
                else{
                  var status_banner = 'blocked';
                }
                swal({
                    title: "Done!",
                    text: " successfully!",
                    type: "success",
                    confirmButtonColor: "#069edb",
                  }).then(() =>{
                  location.reload();
                });
              }
          });
        }
        else
        {
           window.location.replace("{{url('/admin/news')}}");
        }
        });
      }

  </script> 
  


@endsection