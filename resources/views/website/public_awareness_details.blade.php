@extends('layouts.index')
@section('meta_tags')
		{!! Meta::toHtml() !!}
@endsection

@section('content')

<section class="newsWrapper section_padding">
         <div class="container">
              <div class="row">
                   <div class="col-md-12">
                        <a class="back-icon" href="{{route('public_awareness.index')}}">Back to Public Awareness</a>                        
                        <h1 class="newsHeading">{{ (app()->getLocale() == 'en')?$data->name:$data->name_ar}}</h1>
                       <div class="newsContent">
						    <figure class="awrnsPoster">
								@if(app()->getLocale() == 'en')
									<img class="imgHover" src="{{url('/public/uploads/public_awareness/'.$data->image)}}" alt="Natonal Ambulance">
								@else
									<img class="imgHover" src="{{url('/public/uploads/public_awareness/'.$data->image_ar)}}" alt="Natonal Ambulance">
								@endif
							</figure>
							@if(app()->getLocale() == 'en')
									@if($data->objective)
										<h2 class="h2 fw-bold">Objective</h2>
										{!!$data->objective!!}
									@endif
							@else
									@if($data->objective_ar)
										<h2 class="h2 fw-bold">Objective</h2>
										{!!$data->objective_ar!!}
									@endif

							@endif
							<!-- <p class="h5"><em>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</em></p>
							<ul class="ulList mt-4 p-0">
								<li>Delivering reliable emergency medical services in the UAE</li>
								<li>Utilising a modern fleet consistent with international standards</li>
								<li>Operating the 998 frontline emergency ambulance service in&nbsp;the Northern Emirates</li>
								<li>Dedicated Communications Centre equipped with the latest&nbsp;EMS communication technologies&nbsp;</li>
								<li>Utilising latest technology and emergency medical equipment</li>
							</ul> -->

							@if($data->videos)
							<h2 class="h2 fw-bold">Video & Graphics</h2>
							<div class="grid mb-2">
								@php
									$videoArray = json_decode($data->videos);
									$graphicsArray = json_decode($data->graphics);
								@endphp
								@foreach($videoArray as $key=>$video)
									<div class="grid__item">
											<iframe allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" frameborder="0" src="{{$video}}" title="YouTube video player"></iframe>
									</div>
								@endforeach
								@foreach($graphicsArray as $key=>$grap)
									<div class="grid__item">
									 <img src="{{url('public/uploads/public_awareness/'.$grap)}}">
									</div>
								@endforeach
								 
								 <!-- <div class="grid__item">
									<iframe allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/9KE_i9h-WLU?autoplay=0&showinfo=0&controls=0" title="YouTube video player"></iframe>
								 </div>
								 <div class="grid__item">
								 	
								 </div>
								 <div class="grid__item">
								 	 <img src="https://picsum.photos/id/141/2048/1365">
								 </div>
								 <div class="grid__item">
								 	 <img src="https://picsum.photos/id/142/4272/2848">
								 </div>
								 <div class="grid__item">
								 	 <img src="https://picsum.photos/id/146/5184/3456">
								 </div>
								 <div class="grid__item">
								 	 <img src="https://picsum.photos/id/152/3888/2592">
								 </div>
								 <div class="grid__item">
								 	 <img src="https://picsum.photos/id/165/2000/1333">
								 </div>
								 <div class="grid__item">
								 	 <img src="https://picsum.photos/id/174/1600/589">
								 </div>
								 <div class="grid__item">
								 	 <img src="https://picsum.photos/id/178/2592/1936">
								 </div>
								 <div class="grid__item">
								 	 <img src="https://picsum.photos/id/181/1920/1189">
								 </div>
								 <div class="grid__item">
								 	 <img src="https://picsum.photos/id/184/4288/2848">
								 </div>								  -->
							</div>  
							@endif 
							@if(app()->getLocale() == 'en')

								@if($data->poster)
									<p class="mt-4 mb-4"><img src="{{url('public/uploads/public_awareness/'.$data->poster)}}" alt="Natonal Ambulance">
								@endif


							@else
								@if($data->poster_ar)
										<p class="mt-4 mb-4"><img src="{{url('public/uploads/public_awareness/'.$data->poster_ar)}}" alt="Natonal Ambulance">
									@endif
                            @endif
							@if(app()->getLocale() == 'en')

							{!!$data->description!!}
							@else
							{!!$data->description_ar!!}

							@endif
							<!-- start of accordian -->
							<div class="accordion" id="accordionPanel">
								@foreach($data->faq() as $key=>$faq)
								<div class="accordion-item mt-4">
									<h2 class="accordion-header" id="heading{{$key}}">
										<button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
										@if(app()->getLocale() == 'en')

										{{$faq->question}}
										
										@else
										{{$faq->question_ar}}

										@endif
										</button>
									</h2>
									<div id="collapse{{$key}}" class="collapse" aria-labelledby="heading{{$key}}" data-bs-parent="#accordionPanel">
										<div class="accordion-body">
											@if(app()->getLocale() == 'en')

											{{$faq->answer}}

											@else
											{{$faq->answer_ar}}

											@endif
										</div>
									</div>
								</div>
								@endforeach
							</div>
							<!-- End of accordian -->
						</div>
                   </div>                      
              </div>
         </div>
 </section>

@endsection
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


@section('script')

@endsection