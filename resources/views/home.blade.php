@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->

<section class="wrapper">
  <div class="container-fluid" style="min-height:555px">
      <div class="row">
          <div class="col-lg-12 text-center mt-5">
              <!-- <h2>Welcome <b class="text-uppercase navyColor">{{Auth::user()->first_name ." ".Auth::user()->last_name}}</b> to National Ambulance Admin Portal.</h2> -->
              <h2 class="navyColor"><strong>Welcome to National Ambulance Admin Panel</strong></h2>
          </div>
      </div>
  </div><!-- /.container-fluid -->
</section>

@endsection

@section('script')



@endsection