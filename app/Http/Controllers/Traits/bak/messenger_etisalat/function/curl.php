<?php
//License Sender's Name API using CURL method
function addSender($userAccount, $passAccount, $sender,$type, $viewResult=1)
{	
	global $arrayAddSender;
	$url = "http://doo.ae/api/addSender.php";
	$stringToPost = "mobile=".$userAccount."&password=".$passAccount."&sender=".$sender."&type=".$type;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $stringToPost);
	$result = curl_exec($ch);

	if($viewResult)
		$result = printStringResult(trim($result), $arrayAddSender, 'Normal');
	return $result;
}

//Check your Balance API using CURL method
function balanceSMS($userAccount, $passAccount, $viewResult=1)
{
	global $arrayBalance;
	$url = "http://doo.ae/api/balance.php";
	$stringToPost = "mobile=".$userAccount."&password=".$passAccount;
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $stringToPost);
	$result = curl_exec($ch);

	if($viewResult)
		$result = printStringResult(trim($result), $arrayBalance, 'Balance');
	return $result;
}

//Retrieve your password API using CURL method
function forgetPassword($userAccount, $sendType, $viewResult=1)
{
	global $arrayForgetPassword;
	$url = "http://doo.ae/api/forgetPassword.php";
	$stringToPost = "mobile=".$userAccount."&type=".$sendType;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $stringToPost);
	$result = curl_exec($ch);
	
	if($viewResult)
		$result = printStringResult(trim($result) , $arrayForgetPassword);
	return $result;
}

//Send SMS API using CURL method
function sendSMS($userAccount, $passAccount, $numbers, $sender, $msg, $timeSend=0, $dateSend=0, $viewResult=1, $MsgID=0)
{
	global $arraySendMsg;
	$url = "http://doo.ae/api/msgSend.php";
	$applicationType = "24";  
    $msg = convertToUnicode($msg);
	$sender = urlencode($sender);
	$domainName = $_SERVER['SERVER_NAME'];
	$stringToPost = "mobile=".$userAccount."&password=".$passAccount."&numbers=".$numbers."&sender=".$sender."&msg=".$msg."&timeSend=".$timeSend."&dateSend=".$dateSend."&applicationType=".$applicationType."&msgId=".$MsgID;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $stringToPost);
	$result = curl_exec($ch);

	if($viewResult)
		$result = printStringResult(trim($result) , $arraySendMsg);
	return $result;
}

//Send Formatted SMS API using CURL method
function sendSMSWK($userAccount, $passAccount, $numbers, $sender, $msg, $msgKey, $timeSend=0, $dateSend=0, $viewResult=1)
{
	global $arraySendMsgWK;
	$url = "http://doo.ae/api/msgSendWK.php";
	$applicationType = "24";  
    $msg = convertToUnicode($msg);
	$msgKey = convertToUnicode($msgKey);
	$sender = urlencode($sender);
	$domainName = $_SERVER['SERVER_NAME'];
	$stringToPost = "mobile=".$userAccount."&password=".$passAccount."&numbers=".$numbers."&sender=".$sender."&msg=".$msg."&msgKey=".$msgKey."&timeSend=".$timeSend."&dateSend=".$dateSend."&applicationType=".$applicationType;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $stringToPost);
	$result = curl_exec($ch);

	if($viewResult)
		$result = printStringResult(trim($result) , $arraySendMsgWK);
	return $result;
}

//Check Send Status API using CURL method
function sendStatus($viewResult=1)
{
	global $arraySendStatus;	
	$url = "http://doo.ae/api/sendStatus.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	$result = curl_exec($ch);

	if($viewResult)
		$result = printStringResult(trim($result) , $arraySendStatus);
	return $result;
}

//Check Send Status API using CURL method
function senderAvailability($userAccount, $type=0, $viewResult=1)
{	
	global $arraySenderAvailability;
	$url = "http://doo.ae/api/senderAvailability.php";
	$stringToPost = "mobile=".$userAccount."&type=".$type;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $stringToPost);
	$result = curl_exec($ch);

	if($viewResult)
		$result = printStringResult(trim($result) , $arraySenderAvailability);
	return $result;
}
?>