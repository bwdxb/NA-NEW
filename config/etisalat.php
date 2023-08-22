<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services for etisalat messenger SMS service
    |
    */

    //Your mobile number, as registered in Doo.ae.
    'mobile' => env('MAILGUN_DOMAIN'),

    //Your password, as registered in Doo.ae.
    'password' => env('MAILGUN_SECRET'),

    //Sender name that you want to license.
    //Sender name must be a component of characters only (English letters and numbers), and the length of sender's name must not be more than 11 characters.
    'sender' => env('APP_NAME'),

    //Determine the send time, 0 means send now
    //Standard format hh:mm:ss
    'time_send' => 0,

    //Random number that will be attached with the posting, just in case you want to send same message in less than one hour from the first one
    //doo.ae prevents recurrence send the same message within one hour of being sent, except in the case of sending a different value with each send operation
    'msg_id' => rand(1,99999),

    //Determine the send date, 0 means send now
    //Standard format mm:dd:yyyy
    'date_Send' => 0,

    //This variable determine the type of the result
    //0: Returns API result as a number.
    //1: Returns API result as meaningful text.
    'result_type' => 0,

];
