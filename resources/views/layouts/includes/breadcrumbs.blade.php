@php
    $segments=[];
    $l=count(Request::segments())-1
@endphp

@switch(Request::segments()[$l])
    @case('edit')
    @php
        $l--;
        $segments=array_slice(Request::segments(),0,$l);
        //   $segments[]=$model->slug // Model that passed to this included blade file
    @endphp
    @break
    @default
    @php $segments=Request::segments() @endphp
@endswitch
<ul class="breadcrumbs mb-0 mr-4 pl-4" style="display:flex;">
<li class="breadcrumb-item">
<!-- {{auth()->user()}} -->
    @if(auth()->user()->role_id == 1 ||auth()->user()->role_id == 2 ||auth()->user()->role_id == 9)
        <!-- <a href="/admin/home">Dashboard</a> -->
    @else
    <!-- in -->
        <a href="/employee-portal/home">Dashboard</a>
    @endif


</li>

@php
    $link=''
@endphp
@foreach($segments as $sg)
    @php $link.='/'.$sg @endphp

    @if($sg != 'home' && $sg != 'employee-portal' )

        @if($loop->index<$l)
            @if(auth()->user()->role_id == 1 ||auth()->user()->role_id == 2 ||auth()->user()->role_id == 9)
                <li class="breadcrumb-item">
                    <a href="/admin/home">{{ucfirst($sg=='admin'?'dashboard':$sg)}}</a>
                    <!-- <a href="{{$link}}">{{ucfirst($sg=='admin'?'dashboard':$sg)}}</a> -->
                </li>
            @else
                <li class="breadcrumb-item active">
                    {{ucfirst($sg)}}
                </li>
            @endif
        @else
        @if($loop->index<3)
            <li class="breadcrumb-item active">
                {{ucfirst($sg)}}
            </li>
        @endif
        @endif
    @endif

@endforeach


</ul>
<!-- @foreach($segments as $sg)
    @if($loop->index<$l)
        <li class="breadcrumb-item">
            <a href="{{$link}}" class="text-info">{{ucfirst($sg=='admin'?'home':$sg)}}</a>
        </li>
    @else
        <li class="breadcrumb-item active text-danger">
            {{ucfirst($sg)}}
                </li>
@endif
@endforeach -->