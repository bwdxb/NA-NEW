@php
use app\Http\helper\Helper as Helper;
$mainMenu = Helper::getMainMenu();

@endphp
@extends('layouts.index')
{{-- @extends('layouts.index') --}}

@section('content')
<style>
.sl_logo{
    display:none;
}
    </style>
<!-- Content Header (Page header) Banner -->
<!-- <section class="pageBanner"
style="background-image: url({{ url('public/website/images/about-us-banner.jpg') }})">
<div class="pageHeading">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{__('Search')}}</h1>
                <span class="subTitle">{{__('National Ambulance')}}</span>
            </div>
        </div>
    </div>
</div>
</section> -->

<section class="pageWrapper" {{(trim(explode(':',explode('.',url('/'))[0])[1]))=="careers"?"hai":"hello"}}>
    <div class="container">
        <div class="row">
            <div class="col-md-12  mt-5">
                <h2>{{__('Search')}}</h2>
                <ul class="navbar-nav" id="menu">
       
{!!$search_data!!}

        </ul>
                   </div>
        
        </div>
    </div>
</section>

@endsection

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" defer>
// sl_pagination
$(document).ready(function(){
    $(".sl_pagination li>a").each((data,value)=>{
    //   alert($(".sl_pagination").html());
    const queryString = window.location.search;
        // console.log(queryString);
        const urlParams = new URLSearchParams(queryString);
        const search_key = urlParams.get('s');
        var page = $(value).text();
        if(page=='[Prev]'){
            page=parseInt(urlParams.get('page'))-1;
        }else if(page=='[Next]'){
            // alert(urlParams.get('page'));
            page=urlParams.get('page')!=null?parseInt(urlParams.get('page'))+1:2;
        }else if(page=='[السابق]'){//prev
            page=parseInt(urlParams.get('page'))-1;
        }else if(page=='[التالي]'){//next
            // alert(urlParams.get('page'));
            page=urlParams.get('page')!=null?parseInt(urlParams.get('page'))+1:2;
        }
        $(value).attr('href',"/search?s="+search_key+"&page="+page);
        // console.log(urlParams.get('page'));


  });
        $(".sl_result_footer").each((data,value)=>{
            $(value).html($(value).html().replace('http://na.bw.ae/','{{env("APP_URL")}}'));
        });
        $("#sl_main").html($("#sl_main").html().replace(/http%3a%2f%2fna.bw.ae%2f/g,(('{{env("APP_URL")}}').replace(':','%3a')).replace('/','%2f')));
       
  $('.pageWrapper #sl_main .sl_pagination>li a').parent().addClass('page-item');
});
</script>

@section('script')

@endsection