<?php


namespace App\Http\Controllers\Traits;

use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;

trait SmsTrait
{
  function naSmsAuth()
  {
        $soapUrl = "https://nawebservices.nationalambulance.ae/SMS-Using-Email/SMSUsingEmail.asmx"; // asmx URL of WSDL
        $soapUser = "NAAdmin";  //  username
        $soapPassword = "Pass@1234"; // password
        // xml post structure
        $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
        <soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
        <soap12:Header>
        <NASecureToken xmlns="https://nawebservices.nationalambulance.ae/SMSUsingEmail.asmx">
        <UserName>' . $soapUser . '</UserName>
        <Password>' . $soapPassword . '</Password>
        <AuthenticationToken></AuthenticationToken>
        </NASecureToken>
        </soap12:Header>
        <soap12:Body>
        <AuthenticateUser xmlns="https://nawebservices.nationalambulance.ae/SMSUsingEmail.asmx" />
        </soap12:Body>
        </soap12:Envelope>';   // data from the form, e.g. some ID number
        
        $headers = array(
                "Content-type: application/soap+xml;charset=\"utf-8\"",
                "Accept: text/xml",
                "Cache-Control: no-cache",
                "Pragma: no-cache",
                "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL
      
        $url = $soapUrl;
        
        // PHP cURL  for https connection with auth
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //  curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        
        // converting
        $response = curl_exec($ch);
        curl_close($ch);

        // converting
        $response1 = str_replace("<soap:Body>", "", $response);
        $response2 = str_replace("</soap:Body>", "", $response1);
        // convertingc to XML
        $parser = simplexml_load_string($response2);
        $token = $parser->AuthenticateUserResponse;
        $token =json_encode($token);
        // user $parser to get your data out of XML response and to display it.
        
        
        $token = json_decode($token);
        //        var_dump($token->0);
        return $token->AuthenticateUserResult;
}

function feedback_messenger($reciepient_mobile_no, $message)
{
        try {
                //Data, connection, auth
                $dataFromTheForm =  $message; // request data from the form
                // dd($dataFromTheForm);
                $soapUrl = "https://nawebservices.nationalambulance.ae/SMS-Using-Email/SMSUsingEmail.asmx"; // asmx URL of WSDL
                $soapUser = "NAAdmin";  //  username
                $soapPassword = "Pass@1234"; // password
                $token = $this->naSmsAuth();   // getting auth token from national ambulance webserver
                // xml post structure
                $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
                <soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
                <soap12:Header>
                <NASecureToken xmlns="https://nawebservices.nationalambulance.ae/SMSUsingEmail.asmx">
                <UserName>' . $soapUser . '</UserName>
                <Password>' . $soapPassword . '</Password>
                <AuthenticationToken>' . $token . '</AuthenticationToken>
                </NASecureToken>
                </soap12:Header>
                <soap12:Body>
                <sendSMSUsingEmail xmlns="https://nawebservices.nationalambulance.ae/SMSUsingEmail.asmx">
                <pMobileNumber>' . $reciepient_mobile_no . '</pMobileNumber>
                <pMessageBody>' . $dataFromTheForm . '</pMessageBody>
                </sendSMSUsingEmail>
                </soap12:Body>
                </soap12:Envelope>';   // data from the form, e.g. some ID number
                
                $headers = array(
                        "Content-type: application/soap+xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "Cache-Control: no-cache",
                        "Pragma: no-cache",
                        "Content-length: " . strlen($xml_post_string),
                ); //SOAPAction: your op URL
                
                $url = $soapUrl;
                
                // PHP cURL  for https connection with auth
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                
                // converting
                $response = curl_exec($ch);
                curl_close($ch);
                Log::info($response);
                // converting
                $response1 = str_replace("<soap:Body>", "", $response);
                $response2 = str_replace("</soap:Body>", "", $response1);
                
                // convertingc to XML
                $parser = simplexml_load_string($response2);
                Log::info($parser);
                $result = $parser->sendSMSUsingEmailResponse;
                $result = json_decode(json_encode($result));        
                
                return $result->sendSMSUsingEmailResult;
        } catch (Exception $e) {
                Log::error($e);
        }
        
}

      function service_messenger($reciepient_mobile_no, $message)
      {
        try {
                //Data, connection, auth
                $dataFromTheForm =  $message; // request data from the form
                $soapUrl = "https://nawebservices.nationalambulance.ae/SMS-Using-Email/SMSUsingEmail.asmx"; // asmx URL of WSDL
                $soapUser = "NAAdmin";  //  username
                $soapPassword = "Pass@1234"; // password
                $token = $this->naSmsAuth();   // getting auth token from national ambulance webserver
                // xml post structure
                $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
                <soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
                <soap12:Header>
                <NASecureToken xmlns="https://nawebservices.nationalambulance.ae/SMSUsingEmail.asmx">
                <UserName>' . $soapUser . '</UserName>
                <Password>' . $soapPassword . '</Password>
                <AuthenticationToken>' . $token . '</AuthenticationToken>
                </NASecureToken>
                </soap12:Header>
                <soap12:Body>
                <sendSMSUsingEmail xmlns="https://nawebservices.nationalambulance.ae/SMSUsingEmail.asmx">
                <pMobileNumber>' . $reciepient_mobile_no . '</pMobileNumber>
                <pMessageBody>' . $dataFromTheForm . '</pMessageBody>
                </sendSMSUsingEmail>
                </soap12:Body>
                </soap12:Envelope>';   // data from the form, e.g. some ID number
                
                $headers = array(
                        "Content-type: application/soap+xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "Cache-Control: no-cache",
                        "Pragma: no-cache",
                        "Content-length: " . strlen($xml_post_string),
                ); //SOAPAction: your op URL
                
                $url = $soapUrl;
                
                // PHP cURL  for https connection with auth
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                
                // converting
                $response = curl_exec($ch);
                curl_close($ch);
                Log::info($response);
                // converting
                $response1 = str_replace("<soap:Body>", "", $response);
                $response2 = str_replace("</soap:Body>", "", $response1);
                
                // convertingc to XML
                $parser = simplexml_load_string($response2);
                Log::info($parser);
                $result = $parser->sendSMSUsingEmailResponse;
                $result = json_decode(json_encode($result));        
                
                return $result->sendSMSUsingEmailResult;
        } catch (Exception $e) {
                Log::error($e);
        }


    }
}