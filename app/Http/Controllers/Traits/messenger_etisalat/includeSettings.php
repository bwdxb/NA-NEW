<?php

include("function/curl.php");

//Include Function: printStringResult, to print the result of API in meaningful way.
include("function/functionPrintResult.php");

//Include Function: convertToUnicode, to convert messages to our special UNICODE.
include("function/functionUnicode.php");

//This variable is used in case the result of API was undefined
$undefinedResult = "The result of the operation is undefined, please try again";

//Results of check sending status API, in text format
$arraySendStatus = array();
$arraySendStatus[0] = "you can't send now";
$arraySendStatus[1] = "You can send the message now";

//Results of forgot Password API, in text format
$arrayForgetPassword = array();
$arrayForgetPassword[-2] = "connection failed to Doo.ae server";
$arrayForgetPassword[1] = "Your mobile number is incorrect";
$arrayForgetPassword[2] = "Your email is incorrect";
$arrayForgetPassword[3] = "Password sent to mobile number successfully";
$arrayForgetPassword[4] = "your account is not enough to send the new password as SMS";
$arrayForgetPassword[5] = "Password sent to email successfully";

//Results of Send SMS API, in text format
$arraySendMsg = array();
$arraySendMsg[-2] = "connection failed to Doo.ae server";
$arraySendMsg[-1] = "connection failed to Doo.ae Database";
$arraySendMsg[1] = "SMS message sent successfully";
$arraySendMsg[2] = "Your balance is 0";
$arraySendMsg[3] = "Your balance is not enough";
$arraySendMsg[4] = "Your mobile number is incorrect";
$arraySendMsg[5] = "Your Password is incorrect";
$arraySendMsg[12] = "Problem in the Send SMS Message API, Please try again";
$arraySendMsg[13] = "Sender Name not accepted, or not authorized to you";
$arraySendMsg[15] = "Number(s) is empty or incorrect";
$arraySendMsg[16] = "Sender Name is empty";
$arraySendMsg[17] = "Message encoded incorrectly";

//Results of Send Foramatted SMS API, in text format
$arraySendMsgWK = array();
$arraySendMsgWK[-2] = "connection failed to Doo.ae server";
$arraySendMsgWK[-1] = "connection failed to Doo.ae Database";
$arraySendMsgWK[1] = "SMS message sent successfully";
$arraySendMsgWK[2] = "Your balance is 0";
$arraySendMsgWK[3] = "Your balance is not enough";
$arraySendMsgWK[4] = "Your mobile number is incorrect";
$arraySendMsgWK[5] = "Your Password is incorrect";
$arraySendMsgWK[10] = "Values sets count does not equal numbers count";
$arraySendMsgWK[14] = "Sender Name not accepted, or not authorized to you";
$arraySendMsgWK[15] = "Number(s) is empty or incorrect";
$arraySendMsgWK[16] = "Sender Name is empty";
$arraySendMsgWK[17] = "Message encoded incorrectly";

//Results of Check your Balance API, in text format
$arrayBalance = array();
$arrayBalance[-2] = "connection failed to Doo.ae server";
$arrayBalance[1] = "Your mobile number is incorrect";
$arrayBalance[2] = "Your Password is incorrect";

//Results of License Sender's Name API, in text format
$arrayAddSender = array();
$arrayAddSender[-2] = "connection failed to Doo.ae server";
$arrayAddSender[1] = "Your mobile number is incorrect";
$arrayAddSender[2] = "Your Password is incorrect";
$arrayAddSender[3] = "Sender name is incorrect";
$arrayAddSender[4] = "Sender name already exists";
$arrayAddSender[5] = "Mobile number cant be not Licenses as a sender name";
$arrayAddSender[6] = "Process completed successfully";
$arrayAddSender[7] = "Process failed, (in case of characters sender's name)";

//Results of Get your Senders Names API, in text format
$arraySenderAvailability = array();
$arraySenderAvailability[1] = "Your mobile number is incorrect";
?>