@extends('layouts.master')

@section('header-ss')
    <link rel="stylesheet"
          href="{{asset('public/employee_portal/assets/plugins/@mdi/font/css/materialdesignicons.min.css')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
    .table tbody td .h3, .table tbody td h3{font-size:inherit;}
    .adminAction .actionLink{margin:0 2px;}
    .adminAction{display:revert;}
    .adminAction .actionLink{display:inline-flex;}
    </style>
@endsection
@section('content')

    <section class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="content-header w-100">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="mt-4">
                                <h1 class="m-0 text-dark"> <a href="{{url('/admin/career-portal/admin/vacancy')}}" class="btn btn-primary">Back</a> Job Vacancy</h1>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <div class="content w-100">
         
  
                    <div class="row grid-margin mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped adminTable" id="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Job id</th>
                                                <th>Job category</th>
                                                <th>Job title</th>
                                                <th>Department</th>
                                                <th>Closing Date</th>
                                                <th>Updated By</th>
                                                <th>Created At</th>
                                                <th>Operations</th>
                                            </tr>
                                            </thead>
                                            <tbody id="myTable">
                                            @forelse($data as $key=> $d)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $d->job_id }}</td>
                                                  
                                                    <td>{{ $d->job_category }}
                                                    @if($d->bi_lang == 1)
                                                            <br/>
                                                            {{ $d->job_category_ar }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $d->job_title }}
                                                        @if($d->bi_lang == 1)
                                                            <br/>
                                                            {{ $d->job_title_ar }}
                                                        @endif
                                                    </td>
                                                  
                                                
                                                    <td>
                                                        {{ $d->department }}
                                                        @if($d->bi_lang == 1)
                                                            <br/>
                                                            {{ $d->department_ar }}
                                                        @endif
                                                    </td>
                                                
                                                    <td>{{\Carbon\Carbon::createFromFormat('Y-m-d', $d->vacancy_closing_date)->format('d-m-Y')}}</td>
                                                                                                    
                                                    <td>{{$d->user()->full_name()}}</td>
                                                    <td>{{date('d-m-Y',strtotime($d->created_at))."(". \Carbon\Carbon::parse($d->created_at)->diffForHumans().")"}}</td>

                                               
                                                    <td class="adminAction" style="min-width:105px;">
                                                    <a href="{{route('career-portal.admin.vacancy.revert',$d->id)}}" onclick="return confirm('Are u sure you want to revert this record ?')" class="btn btn-info w-100"> Revert</a>              
               <a href="{{route('career-portal.admin.vacancy.revert',$d->id)}}?preview=1"  class="btn btn-info w-100 mt-1"> View</a>              
        
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="9"
                                                        style="text-align: center;">
                                                        <b>No Records Found!!!</b>
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                    </div>
                    {{ $data->links() }} 

                </div>
            </div>
        </div>
    </section>
    <div id="preview-page-content" style="display:none">
      @if(\Session::has('preview_page'))
        {!!\Session::get('preview_page')!!}
      @endif
   </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        @if(\Session::has('preview_page'))
            var w = window.open();
            $().ready(function(){
                $('body').attr('style',"");
            $('#loader').remove();
             $(w.document.body).html($('#preview-page-content').html());
            $('#preview-page-content').remove();
            });
        @endif
     
  
    </script>
  
@endsection