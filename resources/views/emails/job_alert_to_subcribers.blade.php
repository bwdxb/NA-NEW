
      <div class="contact">
        <div style="display:none;font-size:1px;color:white">
            <b>{{__('Job Alert Mail')}}</b>!
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

                                <p style="font-family:'HelveticaNeue-Light','Helvetica Neue Light','Helvetica Neue',Calibri,Helvetica,Arial,sans-serif;font-size:16px;font-stretch:normal;line-height:1.68;color:#3b3e40;margin:0 0 22px;font-weight:bold">
                                @if(app()->getLocale() == 'en')Dear @endif {{$name}},
                                 <br/><br/>

                                 {{__('You are receiving this email because you have subscribed to receive job alerts when we have new opportunities available.')}} 

                                 <br/><br/>
                                 {{__('New vacancy(s) is/ are now available at National Ambulance:')}}
                                 
                                 <br/>
                                 <!-- <a href="{{route('career-portal.user.vacancy.details.view',$vacancy->id)}}">View Added Vacancy</a> -->
                                 
                                 <br/>
                                 <br/>
                                 <a href="{{route('career-portal.user.vacancy.view.all')}}">{{__('Emergency Medical Technician-Basic')}}</a>
                                 <br/>

                                 <a href="{{route('career-portal.user.vacancy.view.all')}}">{{__('Emergency Medical Technician- Intermediate')}}</a>
                                 <br/>
                                  
                                </p>
                                 <p style="font-family:'HelveticaNeue-Light','Helvetica Neue Light','Helvetica Neue',Calibri,Helvetica,Arial,sans-serif;font-size:16px;font-stretch:normal;line-height:1.68;color:#3b3e40;margin:0px;">
                                    {{__('Regards,')}}
                                    <br/>
                                    {{__('National Ambulance Recruitment')}}
                                   
                                </p>   
                                <br />
                               
                                
                             </td>
                          </tr>
                          <tr>
                             <td style="padding:30px 50px;text-align:center;background-color:#f7f7f7;border-top:1px solid #dddddd">
                                <p style="font-family:'Helvetica Neue',Calibri,Helvetica,Arial,sans-serif;font-weight:normal;font-size:10px;color:#666"> {{__('This message was sent by')}}
                                   <a href="http://www.nationalambulance.ae/" style="font-family:'Helvetica Neue',Calibri,Helvetica,Arial,sans-serif;font-size:10px;font-weight:bold;color:#243a76;text-decoration:none" target="_blank">{{__('National Ambulance')}} </a>{{__('Copyright 2023 National Ambulance All rights reserved.')}}
                                </p>
                                <p style="font-family:'HelveticaNeue-Light','Helvetica Neue Light','Helvetica Neue',Calibri,Helvetica,Arial,sans-serif;font-size:12px;font-stretch:normal;line-height:1.68;color:#3b3e40;margin:0px;">Are you no longer interested in receiving job alerts from National Ambulance? <a href="{{route('career-portal.subscription.unsubscribe',['email'=>$email,'hash_key'=>md5( $email . 'S3cr3t@123' )])}}">Unsubscribe here</a></p>
                             </td> 
                          </tr>
                       </tbody>
                    </table>
                 </td>
              </tr>
           </tbody>
        </table>
     </div>
