<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB; 
use Session; 
use App\DocumentLibrary; 
use App\DocumentType; 
use app\Http\helper\Helper as Helper;
use Auth;
use Carbon\Carbon;
class JsonController extends Controller
{
    public function index(Request $request)
    {
        // Read File

        $jsonString = file_get_contents(base_path('resources/csvjson.json'));
        $data = json_decode($jsonString, true);
       
            /**
             * 
             * 
             */
        $docLibArray=[];
            foreach ($data as $value) {
                $docType= DocumentType::where('type',trim($value['Document Type']))->first();
                // /public/controlled_documents/QHSE Management System/QHF106 Cover Page - Restricted.docx
                // http://na.bw.ae/public/controlled_documents/QHF106%20Cover%20Page%20-%20Restricted.docx
                // dd($docType);

                if(!$docType){

                    $docType=new DocumentType(['type'=>$value['Document Type']]);
                    $docType->save();
                }
                $path='';
                switch (trim($value['Department'])) {
                    case 'QHSE':
                        $path='/public/controlled_documents/QHSE Management System/'.trim($value['Full Document Title']);
                        break;
                    case 'Clinical Service':
                        $path='/public/controlled_documents/Clinical Governance/'.trim($value['Full Document Title']);
                        break;
                    case 'Corporate':
                        $path='/public/controlled_documents/Corporate/'.trim($value['Full Document Title']);
                        break;
                    case 'Finance':
                        $path='/public/controlled_documents/Finance/'.trim($value['Full Document Title']);
                        break;
                    case 'Human Resources':
                        $path='/public/controlled_documents/Human Resources/'.trim($value['Full Document Title']);
                        break;
                    case 'IT':
                        $path='/public/controlled_documents/Information Technology/'.trim($value['Full Document Title']);
                        break;
                    case 'Operation':
                        $path='/public/controlled_documents/Operations/'.trim($value['Full Document Title']);
                        break;
                    case 'Supply Chain':
                        $path='/public/controlled_documents/Supply Chain/'.trim($value['Full Document Title']);
                        break;
                    
                }
                // dd((new Carbon(trim($value['Last Review Date'])))->toFormattedDateString());
                if(!DocumentLibrary::where('controlled_number',trim($value['Code']))->where('document_name',trim($value['Full Document Title']))->first()){
                    $dt = new Carbon('');
                    $docLibArray[]=[
                        "document_type_id"=>$docType->id,
                        "controlled_number"=>trim($value['Code']),
                        "document_name"=>trim($value['Full Document Title']),
                        "document_file"=>$path,
                        "version_number"=>trim($value['Version']),
                        "department_owner"=>trim($value['Department']),
                        "data_classification"=>'Public',
                        "document_date"=>new Carbon(trim($value['Last Review Date'])),
                        "file_size"=>file_exists(base_path($path))?$this->formatSizeUnits(filesize(base_path($path))):'nil',
                        "file_type"=>file_exists(base_path($path))?filetype(base_path($path)):'nil',
                        "created_by"=>Auth::user()->id,
                        "updated_by"=>Auth::user()->id
                    ];
                }
            }
            // dd($docLibArray);
            DocumentLibrary::insert($docLibArray);

        return $docLibArray;
    }

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}

