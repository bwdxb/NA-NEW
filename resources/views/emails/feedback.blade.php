@if(app()->getLocale() != 'en')
<style type="text/css">
   p{direction:rtl;text-align:right;}
</style>
@endif
      <div class="contact">
         <div style="display:none;font-size:1px;color:white">
             <b>{{__('Feedback Mail')}}</b>!
         </div>
         <table cellspacing="0" cellpadding="0" border="0" width="100%" style="width:100%;background-color:#f4f6f6">
            <tbody>
               <tr>
                  <td>
                     <table align="center" valign="top" border="0" cellpadding="0" cellspacing="0" width="600" style="width:600px;background:#fff;border:1px solid #dddddd;border-collapse:collapse">
                        <tbody>
                           <tr style="text-align:center;padding:10px">
                              <td>
                                 <a href="<?php echo url('/'); ?>">
                                 <img height="55" border="0" src="{{asset('public/career_portal/images/logo_navyblue.png')}}" alt="National Ambulance" style="padding:20px;vertical-align:bottom">
                                 </a>
                              </td>
                           </tr>
                          
                           <tr style="margin-left: 100px;">
                              <td style="padding:30px 50px">

                                 <p style="font-family:'HelveticaNeue-Light','Helvetica Neue Light','Helvetica Neue',Calibri,Helvetica,Arial,sans-serif;font-size:16px;font-stretch:normal;line-height:1.68;color:#3b3e40;margin:0 0 22px;font-weight:bold; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
                                 <!-- @if(app()->getLocale() == 'en')Dear @endif {{$name}}, -->
                                 {{__('Dear')}} {{$name}}{{__(',')}}
                                 </p>
                                  <p style="font-family:'HelveticaNeue-Light','Helvetica Neue Light','Helvetica Neue',Calibri,Helvetica,Arial,sans-serif;font-size:16px;font-stretch:normal;line-height:1.68;color:#3b3e40;margin:0px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
                                  @switch($type)
    @case("Complaint")
<span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
{{__('Thank you for contacting the National Ambulance Team and taking the time to bring this matter to our attention.')}}
</span>
<span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
{{__('We will contact you within three working days to confirm the details of your complaint and seek to resolve it objectively and in strict confidence.')}} 
</span>
<span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
{{__('Reference #')}}:{{$reference_no}}
</span>
<span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
{{__('National Ambulance is always ready to serve the community.')}}
</span>
<span style="display:block;margin-top:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;display:none;@endif">
{{__('Stay safe.')}}
</span>


        @break

    @case("Compliment")
        <p>
        <span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">{{__('Thank you for contacting the National Ambulance Team and taking the time to share your positive feedback with us. We will pass on your message(s) to our respective team(s). Thank you!')}}
</span>
        <span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
{{__('Reference #:')}}{{$reference_no}}
</span>
<span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
{{__('National Ambulance is always ready to serve the community.')}}
</span>
</p>
<p style="margin-top:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;display:none;@endif">
{{__('Stay safe.')}}
</p>

        @break
    @case("Suggestion")
        <p>
        <span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">{{__('Thank you for contacting the National Ambulance Team and taking the time to share your suggestion(s) with us. It will be passed on to the relevant team(s) for consideration for improving our services.')}}
</span>
        <span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
{{__('Reference #:')}}{{$reference_no}}
</span>
<span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
{{__('National Ambulance is always ready to serve the community.')}}
</span>
</p>
<p style="margin-top:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;display:none;@endif">
{{__('Stay safe.')}}
</p>

        @break
    @case("Request Patient Care Record (PCR)")
        <p>
        <span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">{{__('Thank you for contacting the National Ambulance Team.')}}
</span>
        <span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
        {{__('Your request has been forwarded to the concerned team who will contact you to verify your information before they proceed with it.')}}
</span>
        <span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
        {{__('Reference #:')}}{{$reference_no}}
</span>
        <span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
{{__('National Ambulance is always ready to serve the community.')}}
</span>
</p>
<p style="margin-top:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;display:none;@endif">
{{__('Stay safe.')}}
</p>

        @break
    @default
        <p>
        <span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
{{__('Thank you for contacting the National Ambulance Team.')}}
</span>
<span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
{{__('Your message has been forwarded to the concerned team who will evaluate your request and respond accordingly if required.')}} 
</span>
<span style="display:block;margin-bottom:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
{{__('Reference #:')}}{{$reference_no}}
</span>
</p>
<p style="margin-top:10px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;display:none;@endif">
{{__('Stay safe.')}}
</p>

@endswitch


                                 </p>   
                                
                                  <div style="margin-left: 125px">
                                 
								
                                 </div> 
                                 <br />
                                
                                 
                              </td>
                           </tr>
                           <tr>
                              <td style="padding:30px 50px;text-align:center;background-color:#f7f7f7;border-top:1px solid #dddddd">
                                 <p style="font-family:'Helvetica Neue',Calibri,Helvetica,Arial,sans-serif;font-weight:normal;font-size:10px;color:#666"> {{__('This message was sent by')}}
                                    <a href="http://www.nationalambulance.ae/" style="font-family:'Helvetica Neue',Calibri,Helvetica,Arial,sans-serif;font-size:10px;font-weight:bold;color:#243a76;text-decoration:none" target="_blank">{{__('National Ambulance')}} </a>{{__('Copyright 2023 National Ambulance All rights reserved.')}}
                                 </p>   
                              </td> 
                           </tr>
                        </tbody>
                     </table>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
