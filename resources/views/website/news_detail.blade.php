@extends('layouts.index')
@section('content')
@php
use app\Http\helper\Helper as Helper;
$mainMenuTitle = Helper::mainMenuTitleById(6);
$leftSubMenu = Helper::geSubMenu(6);
$images = json_decode($news->image);
@endphp


@section('meta_tags')
<!-- meta tags from module -->
{!! Meta::toHtml() !!}
<!-- meta tags from module end -->
<?php if($news->cover_img){
    
        ?>  

        <meta name="image" property="og:image" content='{{asset("public/uploads/news/".$news->cover_img)}}'>
        <meta property="og:image:url" content='{{asset("public/uploads/news/".$news->cover_img)}}?i=1' />									  
         <?php }elseif(!empty($news->cover_img)){
             for($i =0; $i<count($images); $i++) {
                ?>  
        
                <meta name="image{{$i}}" property="og:image" content='{{asset("public/uploads/news/".$images[$i])}}'>
                <meta property="og:image:url" content='{{asset("public/uploads/news/".$images[$i])}}?i=1' />									  
                 <?php }}
             ?>
@endsection


<section class="newsWrapper section_padding">
         <div class="container">
              <div class="row">
                   <div class="col-md-12">
                        <a class="back-icon" href="{{url('/page/news')}}">{{__('Back to News')}}</a>                       
                        <h1 class="newsHeading">{{$news->title}}</h1>
                       <!--<p style="font-size:1.2rem">{{$news->short_description}}</p>-->                       
                        <p style="font-size:1.0rem"><em>{{$news->short_description}}</em></p>
                        @if(app()->getLocale() == 'en')
                        <span class="publishDate">
                            @if($news->news_date){{date('d M Y', strtotime($news->news_date))}}@endif
                        </span>
                        @else
                        <span class="publishDate" style="">
                        @if($news->news_date){{date('d', strtotime($news->news_date))." ". __(date('F', strtotime($news->news_date)))." ".date('Y', strtotime($news->news_date))}}@endif
                    </span>
                    @endif
                   </div>
                   <div class="newsTabs">
                        <div class="c-share">
                            <input class="c-share__input" type="checkbox" id="checkbox">
                            <label class="c-share__toggler" for="checkbox">
                               <span class="c-share__icon"></span>
                            </label>
                            <ul class="c-share_options" data-title="Share">
                                <!-- <li><a hget_shortlink_from_idref="#" onclick="window.open('https://twitter.com/intent/tweet/?text=Inside the Northern Emirates field hospitals treating Covid-19 patients&url=http://www.nationalambulance.ae/', 'Twitter-dialog', 'width=626,height=436')"><img src="{{asset('public/website/images/twitter-circled.svg')}}"  alt="Twitter"></a></li>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}&t={{$news->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><img src="{{asset('public/website/images/facebook-circled.svg')}}"  alt="Facebook"></a></li>
                                <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=https://chillyfacts.com/create-linkedin-share-button-on-website-webpages&title=Create LinkedIn Share button on Website Webpages&summary=chillyfacts.com&source=Chillyfacts"><img src="{{asset('public/website/images/linkedin-circled.svg')}}"  alt="Linkedin"></a></li>
                                
                                <li><a class="whatsapp_trigger" href="https://web.whatsapp.com/send?phone=&amp;text=Inside the Northern Emirates field hospitals treating Covid-19 patients : https%3A%2F%2Fwww.seha.ae%3Fp%3D13778"><img src="{{asset('public/website/images/whatsapp.svg')}}"  alt="Whatsapp"></a></li>
                                 <li><a href="mailto:someone@example.com"><img style="margin-top:3px;"width="40px" height="40px" src="{{asset('public/website/images/envelop-circled.svg')}}"  alt="Email"></a></li>                  
                                <li><a href="javascript:void(0); " onclick="window.print()"><img style="margin-top:8px;" width="40px" height="40px" src="{{asset('public/website/images/printer.svg')}}"  alt="Print"></a></li>
                             -->
                                <li><a href="https://twitter.com/share?url={{Request::url()}}&text={{$news->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Twitter"><img src="{{asset('public/website/images/twitter-circled.svg')}}"  alt="Twitter"></a></li>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}&t={{$news->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><img src="{{asset('public/website/images/facebook-circled.svg')}}"  alt="Facebook"></a></li>
                                <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{Request::url()}}&t={{$news->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Linkedin"><img src="{{asset('public/website/images/linkedin-circled.svg')}}"  alt="Linkedin"></a></li>
                                
                                <li><a href="whatsapp://send?text={{Request::url()}}" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on whatsapp"><img src="{{asset('public/website/images/whatsapp.svg')}}"  alt="Whatsapp"></a></li>
                                <li><a href="mailto:?subject={{$news->title}}&body={{Request::url()}}" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Mail"><img style="margin-top:3px;"width="40px" height="40px" src="{{asset('public/website/images/envelop-circled.svg')}}"  alt="Email"></a></li>                  
                                <li><a href="javascript:void(0); " onclick="window.print()"><img style="margin-top:8px;" width="40px" height="40px" src="{{asset('public/website/images/printer.svg')}}"  alt="Print"></a></li>
                            </ul>
                        </div>    
                        
                        <div class="tab-content" id="newsTabContent">
						<div class="inner_tab tab-pane show active" id="pictures" role="tabpanel" aria-labelledby="pictures">
						
							 <div class="newsSlider" data="{{json_encode($images)}}">
                             @if(app()->getLocale()=='ar')                             
							    <?php if(!empty($images)){
                                for($i =count($images)-1; $i>=0; $i--) {?>          
                                <div class="news-item" style="max-height:570px;">
                                    <img src="{{asset('public/uploads/news/'.$images[$i])}}" class="d-block w-100" alt="...">
                                </div>
							    <?php }}?>	
                                @if($news->cover_img)
                                   <div class="news-item cover-ar" style="max-height:570px;">
                                                    <img src="{{asset('public/uploads/news/'.$news->cover_img)}}" class="d-block w-100" alt="...">
                                            </div>
                                   @endif                                       
                                       @else
                                   @if($news->cover_img)
                                   <div class="news-item" style="max-height:570px;">
                                                    <img src="{{asset('public/uploads/news/'.$news->cover_img)}}" class="d-block w-100" alt="...">
                                            </div>
                                   @endif
                                       <?php if(!empty($images)){
                                            for($i =0; $i<count($images); $i++) {?>          
                                            <div class="news-item" style="max-height:570px;">
                                                    <img src="{{asset('public/uploads/news/'.$images[$i])}}" class="d-block w-100" alt="...">
                                            </div>
									        <?php 
                                            }
                                            }
                                            ?>	
                                       @endif
                                   </div>
							 			
						</div>
						 
						<div class="inner_tab tab-pane show" id="video" role="tabpanel" aria-labelledby="video">
							<?php  if(!empty($news->video)) {?>	
							<div class="news-item">
                                 <iframe width="100%" height="600px" src="https://www.youtube.com/embed/<?php echo $news->video?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                           
                            </div>
							<?php }?>		
						</div>
    
                        </div>
						<?php  if(!empty($news->video)) {?>	
                        <ul class="nav nav-tabs step_list" id="nav-tab" role="tablist">
                            <li><a class="nav-link active" href="#pictures" data-bs-toggle="tab" data-bs-target="#pictures" role="tab" aria-controls="pictures" aria-selected="true">{{__('Pictures')}}</a></li>
                            <li><a class="nav-link" href="#video" data-bs-toggle="tab" data-bs-target="#video" role="tab" aria-controls="video" aria-selected="false">{{__('Video')}}</a></li>
                        </ul>
						<?php }?>
                   </div>                                               
                   <div class="col-md-12">
                       <div class="newsContent">                           
                        
                     
                            {!! html_entity_decode($news->description) !!}
                      
                       </div>
                   </div>                      
              </div>
         </div>
 </section>
 <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
 <script>

    </script>
 @endsection
 @section('script')

@endsection