<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://naservicedesk.nationalambulance.ae/sdpapi/request',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('INPUT_DATA' => '{
    "operation": {
        "details": {
			"requester": "Guest",
			"subject": "Specify Subject",
			"description": "Specify Description",
			"requesttemplate": "requesttemplate",
			"site": "Newyork",
			"technician": "",
			"level": "Tier 3",
			"status": "open",
            "from": "10",
            "limit": "11",
            "filterby": "All_Requests"
        }
    }
}','TECHNICIAN_KEY' => 'E22F5785-49A7-454B-9A16-A15CF97E5D04','OPERATION_NAME' => 'ADD_REQUEST','format' => 'json'),
  CURLOPT_HTTPHEADER => array(
    'Cookie: SDPSESSIONID=CE51E613B19F7936DC1BBE92397B0768; sdpcsrfcookie=12744fa4-d5d0-4f41-a84d-c43c3be01215'
  ),
));

$response = curl_exec($curl);
 
curl_close($curl); 
print_r($response); 

?>

<html>
<head>
<title>API</title>
</head>
<body>





</body>
</html>