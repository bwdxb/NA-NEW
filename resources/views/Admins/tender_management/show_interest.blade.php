
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
            <h1 class="m-0 text-dark" >Show Banner</h1>
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<section class="content">
   <div class="container-fluid">
   
      
        @csrf
          @method('PUT')
         <div class="form-group">
            <div class="row">
               <label class="col-sm-3"> Name</label>
                <div class="col-sm-6"><input type="text" name="name" class="form-control" value="{{$interests[0]->name}}" maxlength="25" disabled="disabled">
                </div>
                 
            </div>
			<br>
			<div class="row">
               <label class="col-sm-3">Email</label>
                <div class="col-sm-6"><input type="text" name="email" class="form-control" value="{{$interests[0]->email}}" maxlength="25" disabled="disabled">
                </div>
                
            </div>
			<br />
			<div class="row">
               <label class="col-sm-3">Company</label>
                <div class="col-sm-6"><input type="text" name="company" class="form-control" value="{{$interests[0]->company}}" maxlength="25" disabled="disabled">
				
                </div>
                 
            </div>
			<br />
			
			<div class="row">
               <label class="col-sm-3">Tender</label>
                <div class="col-sm-6"><select id="orgType" class="form-control" name="tender_id" disabled="disabled">
									  <option value="">Tender Name</option>
									  @foreach($tenders as $key=>$value)
									  <option value="{{$key}}" @if($key ==$interests[0]->tender_id) selected="selected" @endif>{{$value}}</option>
									  @endforeach
									 
								  </select>
				
                </div>
                 
            </div>
		<br />
			<div class="row">
               <label class="col-sm-3">Company</label>
                <div class="col-sm-6"><input type="text" name="company" class="form-control" value="{{$interests[0]->company}}" maxlength="25" disabled="disabled">
				
                </div>
                 
            </div>
			
			<br />
			<div class="row">
               <label class="col-sm-3">Phone</label>
                <div class="col-sm-6"><input type="text" name="phone" class="form-control" value="{{$interests[0]->phone}}" maxlength="25" disabled="disabled">
				
                </div>
                 
            </div>
			<br />
			<div class="row">
               <label class="col-sm-3">Landline</label>
                <div class="col-sm-6"><input type="text" name="landline" class="form-control" value="{{$interests[0]->landline}}" maxlength="25" disabled="disabled">
				
                </div>
                 
            </div>
			<br />
			<div class="row">
               <label class="col-sm-3">Comment</label>
                <div class="col-sm-6">
				<textarea class="form-control" name="comment" rows="3">{{$interests[0]->comment}}</textarea>
                </div>
                 
            </div>
			 <br />          
            <div class="form-group text-center">
               <a href="{{url('/admin/manage_express_interest')}}" class="btn btn-info ">Back</a>
            </div>
         </div>
      </form>
   </div>
 </section>


</div>
           
</section>
		
		
	</div>
</div>  
 </section>

@endsection