@extends('layouts.index')
@section('meta_tags')
		{!! Meta::toHtml() !!}
@endsection

@section('content')
<!-- Content Header (Page header) Banner -->
<section class="pageBanner"
style="background-image: url({{url('public/uploads/cms/8475.jpg') }})">
<div class="pageHeading">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{__('Public Awareness')}}</h1>
                <span class="subTitle">{{__('National Ambulance')}}</span>
            </div>
        </div>
    </div>
</div>
</section>

<!--Banner end-->
<section class="pageBreadcrumbs">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb" class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">
                           Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Public Awareness
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!--pageBreadcrumbs end-->
<section class="public_awareness section_padding">
    <div class="container">
        <div class="row">
             <form action="" method="get" id="filter-form">
                <div class="col-md-12 pbFilter">
                    <div class="search">
                        <input type="text" name="search" class="inputSearch" placeholder="Search" value="{{Request::get('search')}}"/> 
                    </div>
                    <div class="selectFilter">
                        <select class="form-control" name="sort" onchange="this.form.submit()">
                            <option value="newest" @if(Request::get('sort')=='newest') selected @endif>Newest</option>
                            <option value="oldest" @if(Request::get('sort')=='oldest') selected @endif>Oldest</option>
                        </select>   
                    </div>
                </div>
             </form>
             <div class="col-md-12 awrnesListBlock">
                 @foreach($data as $key=>$pw)
                 <div class="awrnesItem">
                     <div class="awrnesImage">
                        @if(app()->getLocale() == 'en')
                            <img src="{{url('/public/uploads/public_awareness/'.$pw->image)}}">
                        @else
                            <img src="{{url('/public/uploads/public_awareness/'.$pw->image_ar)}}">

                        @endif
                     </div>
                     <div class="awrnesContent">
                        @if(app()->getLocale() == 'en')
                            <h3>{{$pw->name}}</h3>
                            <p>{{substr(html_entity_decode(strip_tags($pw->description)),0,300).'...'}}</p>
                            @else
                            <h3>{{$pw->name_ar}}</h3>
                            <p>{{substr(html_entity_decode(strip_tags($pw->description_ar)),0,300).'...'}}</p>
                        @endif
                         <p class="mt-4">
                             <a class="default_btn navyblue_btn" href="{{route('public_awareness.detail',$pw->id)}}">Learn More</a>
                         </p>
                     </div>
                 </div>
                 @endforeach
                 <!-- <div class="awrnesItem">
                     <div class="awrnesImage">
                         <img src="{{asset('public/website/images/user-2.jpg')}}">
                     </div>
                     <div class="awrnesContent">
                         <h3>Sed ut perspiciatis unde error sit voluptatem.</h3>
                         <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de 
                         Finibus Bonorum et Malorum" by Cicero ...</p>
                         <p class="mt-4">
                             <a class="default_btn navyblue_btn" href="#">Learn More</a>
                         </p>
                     </div>
                 </div>
                 <div class="awrnesItem">
                     <div class="awrnesImage">
                         <img src="{{asset('public/website/images/user-3.jpg')}}">
                     </div>
                     <div class="awrnesContent">
                         <h3>At vero eos et accusamus et iusto odio dignissimos.</h3>
                         <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de 
                         Finibus Bonorum et Malorum" by Cicero ...</p>
                         <p class="mt-4">
                             <a class="default_btn navyblue_btn" href="#">Learn More</a>
                         </p>
                     </div>
                 </div> -->
             </div>
        </div>
    </div>
</section>

@endsection
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


@section('script')

@endsection