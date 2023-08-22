<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Log;

trait RequestManageEngineTrait
{
    private function feedbackRequestManageEngine($data)
    {
        $description = '';
        foreach ($data as $key => $d) {
            if (!$d) {
                continue;
            }
            $description .= strtoupper($key) . ' :' . $d . '<br>';
        }
        $description = substr($description, 0, -1);

        $curl = curl_init();
        $data['type'] = 'Feedback - ' . $data['type'];
        $data['subject'] = $data['type'] . ' ref- ' . $data['reference_number'];
        curl_setopt_array($curl, [
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
            CURLOPT_POSTFIELDS => ['INPUT_DATA' => '{
                "operation": {
                   "details": {
                      "SUBJECT": "' . $data['subject'] . '",
                      "name": "' . $data['name'] . '",
                      "requester":"' . $data['name'] . '",
                      "email": "' . $data['email'] . '",
                      "DESCRIPTION": "' . $description . '",
                      "requesttype": "Service Request",
                      "priority": "Normal",
                      "category": "QHSE Services",
                      "site": "WebSite",
                      "group": "QHSE",
                      "technician":"",
                      "level": "Tier 1",
                      "status": "open",
                      "service": "WebSite"
                  }
              }
          }', 'TECHNICIAN_KEY' => 'E22F5785-49A7-454B-9A16-A15CF97E5D04', 'OPERATION_NAME' => 'ADD_REQUEST', 'format' => 'json'],
            CURLOPT_HTTPHEADER => [
                'Cookie: SDPSESSIONID=CE51E613B19F7936DC1BBE92397B0768; sdpcsrfcookie=12744fa4-d5d0-4f41-a84d-c43c3be01215',
            ],
        ]);

        $response = curl_exec($curl);

        // dd($response);
        curl_close($curl);
        // print_r($response);
        Log::error('mail data : ');
        Log::error($response);

        return json_encode($response);
    }

    private function ptServiceRequestManageEngine($data)
    {
        $description = '';
        foreach ($data as $key => $d) {
            if (!$d) {
                continue;
            }
            $description .= strtoupper($key) . ' : ' . $d . '<br>';
        }
        $description = substr($description, 0, -1);

        $curl = curl_init();
        curl_setopt_array($curl, [
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
            CURLOPT_POSTFIELDS => ['INPUT_DATA' => '{
                "operation": {
                   "details": {
                      
                      "SUBJECT": "PTS",
                      "name": "' . $data['name'] . '",
                      "DESCRIPTION": "' . $description . '",
                      "requester":"' . $data['name'] . '",
                      "requesttype": "Service Request",
                      "priority": "Normal",
                      "category": "Events Services",
                      "site": "WebSite",
                      "group": "Events",
                      "technician":"",
                      "level": "Tier 1",
                      "status": "open",
                      "service": "WebSite"
                  }
              }
          }', 'TECHNICIAN_KEY' => 'E22F5785-49A7-454B-9A16-A15CF97E5D04', 'OPERATION_NAME' => 'ADD_REQUEST', 'format' => 'json'],
            CURLOPT_HTTPHEADER => [
                'Cookie: SDPSESSIONID=CE51E613B19F7936DC1BBE92397B0768; sdpcsrfcookie=12744fa4-d5d0-4f41-a84d-c43c3be01215',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        // dd($response);
        // print_r($response);
        Log::error('mail data : ');
        Log::error($response);

        return json_encode($response);
    }

    private function eventServiceRequestManageEngine($data)
    {
        $description = '';
        
        foreach ($data as $key => $d) {
            if (!$d) {
                continue;
            }
            $description .= strtoupper($key) . ' : ' . $d . '<br>';
        }
        $description = substr($description, 0, -1);
$subject="Event Ambulance Coverage Service - ".$data['event_name']." On ".$data['event_start_date'];
        // dd($description);
        $curl = curl_init();
        curl_setopt_array($curl, [
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
            CURLOPT_POSTFIELDS => ['INPUT_DATA' => '{
                "operation": {
                   "details": {
                      
                      "SUBJECT": "'.$subject.'",
                      "DESCRIPTION": "' . $description . '",
                      "requester":"'.$data['event_name'].'",
                      "requesttype": "Service Request",
                      "priority": "Normal",
                      "category": "Events Services",
                      "site": "WebSite",
                      "group": "Events",
                      "technician":"",
                      "level": "Tier 1",
                      "status": "open",
                      "service": "WebSite"
                  }
              }
          }', 'TECHNICIAN_KEY' => 'E22F5785-49A7-454B-9A16-A15CF97E5D04', 'OPERATION_NAME' => 'ADD_REQUEST', 'format' => 'json'],
            CURLOPT_HTTPHEADER => [
                'Cookie: SDPSESSIONID=CE51E613B19F7936DC1BBE92397B0768; sdpcsrfcookie=12744fa4-d5d0-4f41-a84d-c43c3be01215',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        // dd($response);
        // print_r($response);
        Log::error('mail data : ');
        Log::error($response);

        return json_encode($response);
    }

    private function generalVacancyRequestManageEngine($data)
    {
        $description = '';
        foreach ($data as $key => $d) {
            if (!$d) {
                continue;
            }
            $description .= strtoupper($key) . ' :' . $d . '<br>';
        }
        $description = substr($description, 0, -1);

        $curl = curl_init();

        curl_setopt_array($curl, [
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
            CURLOPT_POSTFIELDS => ['INPUT_DATA' => '{
                "operation": {
                   "details": {
                      "SUBJECT": "General Vacancy",
                      "name": "' . $data['name'] . '",
                      "email": "' . $data['email'] . '",
                      "DESCRIPTION": "' . $description . '",
                      "requester":"' . $data['name'] . '",
                      "requesttype": "Service Request",
                      "priority": "Normal",
                      "category": "HR Services",
                      "site": "WebSite",
                      "group": "Recruitment",
                      "technician":"",
                      "level": "Tier 1",
                      "status": "open",
                      "service": "WebSite"
                  }
              }
          }', 'TECHNICIAN_KEY' => 'E22F5785-49A7-454B-9A16-A15CF97E5D04', 'OPERATION_NAME' => 'ADD_REQUEST', 'format' => 'json'],
            CURLOPT_HTTPHEADER => [
                'Cookie: SDPSESSIONID=CE51E613B19F7936DC1BBE92397B0768; sdpcsrfcookie=12744fa4-d5d0-4f41-a84d-c43c3be01215',
            ],
        ]);

        $response = curl_exec($curl);

        // dd($response);
        curl_close($curl);
        // print_r($response);
        Log::error('mail data : ');
        Log::error($response);

        return json_encode($response);
    }

    private function jobApplicationRequestManageEngine($data)
    {
        try {
            $description = '';
            foreach ($data as $key => $d) {
                if (!$d) {
                    continue;
                }
                $description .= strtoupper($key) . ' :' . $d.'  <br>  ';
            }
            $description = nl2br(substr($description, 0, -1));
            $description = str_replace(["\""], '\'', $description);
            $description = str_replace(["\r\n", "\r", "\n"], '<br/>', $description);
            

            // $subject = ("Request Id ".$data["reference_no"]." Job Application ".$data["job-desc"]." has been assigned to you.");
            $subject = ("Job Application:  ".$data["reference_no"].", ".$data["job_title"].", ".$data['job_id']);
            $curl = curl_init();

            curl_setopt_array($curl, [
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
                CURLOPT_POSTFIELDS => ['INPUT_DATA' => '{
                "operation": {
                   "details": {
                      "SUBJECT": "' . $subject . '",
                      "name": "' . $data['name'] . '",
                      "email": "' . $data['email'] . '",
                      "DESCRIPTION": "' . $description . '",
                      "requester":"' . $data['name'] . '",
                      "requesttype": "Service Request",
                      "priority": "Normal",
                      "category": "HR Services",
                      "site": "WebSite",
                      "group": "Recruitment",
                      "technician":"",
                      "level": "Tier 1",
                      "status": "open",
                      "service": "WebSite"
                  }
              }
          }', 'TECHNICIAN_KEY' => 'E22F5785-49A7-454B-9A16-A15CF97E5D04', 'OPERATION_NAME' => 'ADD_REQUEST', 'format' => 'json'],
                CURLOPT_HTTPHEADER => [
                    'Cookie: SDPSESSIONID=CE51E613B19F7936DC1BBE92397B0768; sdpcsrfcookie=12744fa4-d5d0-4f41-a84d-c43c3be01215',
                ],
            ]);

            $response = curl_exec($curl);

        
            curl_close($curl);
            // print_r($response);
            Log::error('mail data : ');
            Log::error($response);
        // dd('{
        //     "operation": {
        //        "details": {
        //           "SUBJECT": "' . $subject . '",
        //           "name": "' . $data['name'] . '",
        //           "email": "' . $data['email'] . '",
        //           "DESCRIPTION": "' . $description . '",
        //           "requester":"' . $data['name'] . '",
        //           "requesttype": "Service Request",
        //           "priority": "Normal",
        //           "category": "Human Resources",
        //           "site": "WebSite",
        //           "group": "Human Resources",
        //           "technician":"",
        //           "level": "Tier 1",
        //           "status": "open",
        //           "service": "WebSite"
        //       }
        //   }
        // }');
            return json_encode($response);
        } catch (Exception $ex) {
            // dd($ex);
            Log::error($ex);
            
        }
    }

    private function educationTrainingRequestManageEngine($data)
    {
        $description = '';
        foreach ($data as $key => $d) {
            if (!$d) {
                continue;
            }
            $description .= strtoupper($key) . ' : ' . $d . '<br>';
        }
        $description = substr($description, 0, -1);
        $subject="Individual/Grp- EMS Educational Training Request";
        if($data['training_type']=='organisation'){

            $subject=$data['organisation_name']." - EMS Educational Training Request";
        }
        // dd($description);
        $curl = curl_init();
        curl_setopt_array($curl, [
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
            CURLOPT_POSTFIELDS => ['INPUT_DATA' => '{
                "operation": {
                   "details": {
                      
                      "SUBJECT": "'.$subject.'",
                      "DESCRIPTION": "' . $description . '",
                      "requester":"'.$data['name'].'",
                      "requesttype": "Service Request",
                      "priority": "Normal",
                      "category": "Education Services",
                      "site": "WebSite",
                      "group": "Education",
                      "technician":"",
                      "level": "Tier 1",
                      "status": "open",
                      "service": "WebSite"
                  }
              }
          }', 'TECHNICIAN_KEY' => 'E22F5785-49A7-454B-9A16-A15CF97E5D04', 'OPERATION_NAME' => 'ADD_REQUEST', 'format' => 'json'],
            CURLOPT_HTTPHEADER => [
                'Cookie: SDPSESSIONID=CE51E613B19F7936DC1BBE92397B0768; sdpcsrfcookie=12744fa4-d5d0-4f41-a84d-c43c3be01215',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        // dd($response);
        // print_r($response);
        Log::error('mail data : ');
        Log::error($response);

        return json_encode($response);
    }

    private function courseApplyRequestManageEngine($data)
    {

        
        // dd($description);
        try{
            $description = '';
            foreach ($data as $key => $d) {
                if (!$d) {
                    continue;
                }
                $description .= strtoupper($key) . ' : ' . $d . '<br>';
            }
            $description = substr($description, 0, -1);
            $subject="Course Apply Request for ".$data['course']." - Reference Number : ".$data['reference_no'];
          $curl = curl_init();
        curl_setopt_array($curl, [
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
            CURLOPT_POSTFIELDS => ['INPUT_DATA' => '{
                "operation": {
                   "details": {
                      
                      "SUBJECT": "' . $subject . '",
                      "DESCRIPTION": "' . $description . '",
                      "requester":"'.$data['name'].'",
                      "requesttype": "Service Request",
                      "priority": "Normal",
                      "category": "Education Services",
                      "site": "WebSite",
                      "group": "Education",
                      "technician":"",
                      "level": "Tier 1",
                      "status": "open",
                      "service": "WebSite"
                  }
              }
          }', 'TECHNICIAN_KEY' => 'E22F5785-49A7-454B-9A16-A15CF97E5D04', 'OPERATION_NAME' => 'ADD_REQUEST', 'format' => 'json'],
            CURLOPT_HTTPHEADER => [
                'Cookie: SDPSESSIONID=CE51E613B19F7936DC1BBE92397B0768; sdpcsrfcookie=12744fa4-d5d0-4f41-a84d-c43c3be01215',
            ],
        ]);
        
        $response = curl_exec($curl);

        curl_close($curl);
        // dd($response);
        // print_r($response);
        Log::error('mail data : ');
        Log::error($response);

        return json_encode($response);
      }catch(Exception $ex){
          Log::error($ex);
      }
        
    }
}
