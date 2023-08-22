
      <div class="contact">
         <div style="display:none;font-size:1px;color:white">
             <b>{{__('Market Place Mail')}}</b>!
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
                                 </p>
                                  <p style="font-family:'HelveticaNeue-Light','Helvetica Neue Light','Helvetica Neue',Calibri,Helvetica,Arial,sans-serif;font-size:16px;font-stretch:normal;line-height:1.68;color:#3b3e40;margin:0px;">
                                   
                                  {{$iuser}} {{__('expressed interest in speaking to you about your product')}} ({{$product_name}}). {{__('Give them a call or drop them an email to discuss this further. Already sold your product? Congrats! Please delete the advert to stop receiving buyer notifications')}}

<br/>

                                 </p>   
                                
                                   
                                 <br />
                                
                                 
                              </td>
                           </tr>
                           <tr>
                              <td style="padding:30px 50px;text-align:center;background-color:#f7f7f7;border-top:1px solid #dddddd">
                              {{__('Disclaimer: National Ambulance (NA) is not responsible or will not be held liable for the products advertised on the marketplace. NA neither facilitates the payment nor delivery of items posted in the marketplace, and also is not able to verify whether a buyer or seller received what was agreed upon between them. NA is also not responsible for any disputes arising for purchases made for products available via the marketplace.')}}
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
