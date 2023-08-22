<?php
include("includeSettings.php");			//Include this file to get the general settings
$mobile = ""; 							//Your mobile number, as registered in Doo.ae.
$password = "";							//Your password, as registered in Doo.ae.

$sender = "sms Msg";					//Message sender, will be encoded to urlencode automatically

$numbers = "";							//the mobile number or set of mobiles numbers that the SMS message will be sent to them, each number must be in international format, without zeros or symbol (+), and separated from others by the symbol (,).

$msg = "Welcome to doo.ae sms";	//Mesage Text, will be encoded to our APU UNICODE automatically
											//Messages in English: if the length of message is 160 characters or less, only one point will be deducted, if the length is more than 160 characters, then one point will be deducted for every 158 characters of the message.
											//Messages in Arabic (or English & Arabic): if the length of message is 70 characters or less, only one point will be deducted, if the length is more than 160 characters, then one point will be deducted for every 67 characters of the message.											
											//Message must be in Windows-1256 character set before it's used here, and you can convert it to the required character set using ICONV function in PHP
										
$timeSend = 0;							//Determine the send time, 0 means send now
										//Standard format hh:mm:ss
										
$MsgID = rand(1,99999);					//Random number that will be attached with the posting, just in case you want to send same message in less than one hour from the first one
										//doo.ae prevents recurrence send the same message within one hour of being sent, except in the case of sending a different value with each send operation

$dateSend = 0;							//Determine the send date, 0 means send now
										//Standard format mm:dd:yyyy
										
$resultType = 0;						//This variable determine the type of the result
										//0: Returns API result as a number.
										//1: Returns API result as meaningful text.											

//Call sendSMS function, to send SMS
echo sendSMS($mobile, $password, $numbers, $sender, $msg, $timeSend, $dateSend, $resultType,$MsgID);
?>