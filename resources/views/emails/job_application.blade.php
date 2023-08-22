<div class="contact">
   <div style="display:none;font-size:1px;color:white">
   <b>{{__('Job Application Response Mail')}}</b>!
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
                        <br/><br/>
                        
                        {{__('Thank you for your interest in the')}} {{$job_title}} {{__('position at National Ambulance and for taking the time to apply. Your application will be screened and reviewed and we will contact you if your qualifications match our criteria.')}}
                        <br/><br/>

                        {{__('Thank you again for your interest in National Ambulance and the time you invested in your application.')}}
                        <br/><br/>
                     Reference Number: {{$reference_no}}</p>
                        <br/>
                     <p style="font-family:'HelveticaNeue-Light','Helvetica Neue Light','Helvetica Neue',Calibri,Helvetica,Arial,sans-serif;font-size:16px;font-stretch:normal;line-height:1.68;color:#3b3e40;margin:0px; @if(app()->getLocale() != 'en')direction:rtl;text-align:right;@endif">
                        {{__('With appreciation,')}}
                        <br/>
                        {{__('National Ambulance Recruitment')}}
                        
                     </p>   
                     <br />
                     
                     
                  </td>
               </tr>
               <tr>
                  <td style="padding:30px 50px;text-align:center;background-color:#f7f7f7;border-top:1px solid #dddddd">
                     <p style="font-family:'Helvetica Neue',Calibri,Helvetica,Arial,sans-serif;font-weight:normal;font-size:10px;color:#666"> 
                     {{__('This is an automatically generated email, please do not reply to it. <!--If you have any queries regarding your application')}}<br>{{__('please email:')}} <a style="color:#243a76;" href="mailto:recruitment@nationalambulance.ae">recruitment@nationalambulance.ae</a>--></p>
                     <p style="font-size:10px;"><a href="http://www.nationalambulance.ae/" style="font-family:'Helvetica Neue',Calibri,Helvetica,Arial,sans-serif;font-size:10px;font-weight:bold;color:#243a76;text-decoration:none" target="_blank">{{__('National Ambulance')}} </a>{{__('Copyright 2023 National Ambulance All rights reserved.')}}</p>  
                  </td> 
               </tr>
            </tbody>
         </table>
      </td>
            </tr>
         </tbody>
      </table>
   </div>
   