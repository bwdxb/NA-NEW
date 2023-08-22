<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\DocumentLibrary;
use App\Menu;
use Session;
use Auth;
use Carbon\Carbon;

use app\Http\helper\Helper as Helper;

class DocumentLibraryController extends Controller
{

    public function index(Request $request)
    {
        Helper::checkUserSession();
        Helper::checkPagePermission('VW_CMS', 'view', session('userRoleIDs'));
        $document_type = DB::table('document_type')->pluck('type', 'id');
        $documents = DB::table('document_type')->join('document_library', 'document_type.id', '=', 'document_library.document_type_id');
        if (isset($request->document_type_id)) {
            $documents = $documents->where('document_library.document_type_id', '=', $request->document_type_id);
        }
        if (isset($request->search_key)) {
            $documents = $documents->where('document_library.document_name', 'LIKE', '%' . $request->search_key . '%')->orWhere('document_library.controlled_number', 'LIKE', $request->search_key . '%');
        }
        if (isset($request->department_owner)) {
            $documents = $documents->where('document_library.department_owner', $request->department_owner);
        }

        $documents = $documents->select('document_type.type as document_type', 'document_library.*');
        if (isset($request->sort) && $request->sort == 'ASC') {

            $documents = $documents->orderBy('id', 'ASC');
        } else {
            $documents = $documents->orderBy('id', 'DESC');
        }


        $documents = $documents->Paginate(10);

        // $documents = $documents->select('document_type.type as document_type', 'document_library.*')->orderBy('id', 'DESC')->Paginate(10);

        return view('Admins.document_library.index', compact('documents', 'document_type'))->with('i', 1);
    }
    public function show(Request $request)
    {
        Helper::checkUserSession();
        Helper::checkPagePermission('VW_CMS', 'view', session('userRoleIDs'));
        $document_type = DB::table('document_type')->pluck('type', 'id');
        $documents = DB::table('document_type')->join('document_library', 'document_type.id', '=', 'document_library.document_type_id');
        if (isset($request->document_type_id)) {
            $documents = $documents->where('document_library.document_type_id', '=', $request->document_type_id);
        }
        if (isset($request->search_key)) {
            $documents = $documents->where('document_library.document_name', 'LIKE', '%' . $request->search_key . '%')->orWhere('document_library.controlled_number', 'LIKE', $request->search_key . '%');
        }
        if (isset($request->department_owner)) {
            $documents = $documents->where('document_library.department_owner', $request->department_owner);
        }

        $documents = $documents->select('document_type.type as document_type', 'document_library.*');
        if (isset($request->sort) && $request->sort == 'ASC') {

            $documents = $documents->orderBy('id', 'ASC');
        } else {
            $documents = $documents->orderBy('id', 'DESC');
        }


        $documents = $documents->Paginate(10);

        // $documents = $documents->select('document_type.type as document_type', 'document_library.*')->orderBy('id', 'DESC')->Paginate(10);

        return view('Admins.document_library.index', compact('documents', 'document_type'))->with('i', 1);
    }

    public function create()
    {
        Helper::checkUserSession();
        Helper::checkPagePermission('CR_CMS', 'view', session('userRoleIDs'));
        $document_type = DB::table('document_type')->pluck('type', 'id');

        return view('Admins.document_library.create', compact('document_type'));
    }

    public function store(Request $request)
    {
        $dt = Carbon::now();
        $dt->year = $request->year;
        $dt->month = $request->month;
        $dt->day = 1;
        $document = new DocumentLibrary();
        $document->document_type_id = $request->document_type_id;
        $document->controlled_number = $request->controlled_number;
        $document->document_name = $request->document_name;
        $document->version_number = $request->version_number;
        $document->department_owner = $request->department_owner;
        $document->data_classification = $request->data_classification;
        $document->document_date = $dt;

        $document->created_by = Auth::user()->id;
        $path = '';
        switch (trim($request->department_owner)) {
            case 'QHSE':
                $path = '/controlled_documents/QHSE Management System/';
                break;
            case 'Clinical Service':
                $path = '/controlled_documents/Clinical Governance/';
                break;
            case 'Corporate':
                $path = '/controlled_documents/Corporate/';
                break;
            case 'Finance':
                $path = '/controlled_documents/Finance/';
                break;
            case 'Human Resources':
                $path = '/controlled_documents/Human Resources/';
                break;
            case 'IT':
                $path = '/controlled_documents/Information Technology/';
                break;
            case 'Operation':
                $path = '/controlled_documents/Operations/';
                break;
            case 'Supply Chain':
                $path = '/controlled_documents/Supply Chain/';
                break;
            default:
                $path = '/controlled_documents/'.trim($request->department_owner).'/';
                break;
        }
        if(!file_exists(public_path($path))){            
            mkdir(public_path($path), 0777, true);            
        }

        if ($request->hasFile('document_file')) {

            $image = $request->file('document_file');
            $file_type = $image->getMimeType();
            $file_size = $this->formatSizeUnits($image->getSize());
            $new_name = rand(1000, 9999) . '.' . $image->getClientOriginalName();
            $image->move(public_path($path), $new_name);
            $document->document_file =  '/public' . $path . $new_name;
        }
        if ($document->save()) {

            Session::flash('message', 'Document Library has been added successfully');
            return redirect()->route('document_library.index');
        } else {
            Session::flash('error', 'Document Library not added successfully');
            return redirect()->route('document_library.index');
        }
    }

    public function edit($id)
    {
        $document = DocumentLibrary::find($id);
        $document_type = DB::table('document_type')->pluck('type', 'id');

        return view('Admins.document_library.edit', compact('document', 'document_type'));
    }

    public function update(Request $request, $id)
    {
        $dt = Carbon::now();
        $dt->year = $request->year;
        $dt->month = $request->month;
        $dt->day = 1;
        $document = DocumentLibrary::where('id', $id)->first();
        $document->document_type_id = $request->document_type_id;
        $document->controlled_number = $request->controlled_number;
        $document->document_name = $request->document_name;
        $document->version_number = $request->version_number;
        $document->department_owner = $request->department_owner;
        $document->data_classification = $request->data_classification;
        $document->document_date = $dt;
        $document->created_by = Auth::user()->id;
        $path = '';
        switch (trim($request->department_owner)) {
            case 'QHSE':
                $path = '/controlled_documents/QHSE Management System/';
                break;
            case 'Clinical Service':
                $path = '/controlled_documents/Clinical Governance/';
                break;
            case 'Corporate':
                $path = '/controlled_documents/Corporate/';
                break;
            case 'Finance':
                $path = '/controlled_documents/Finance/';
                break;
            case 'Human Resources':
                $path = '/controlled_documents/Human Resources/';
                break;
            case 'IT':
                $path = '/controlled_documents/Information Technology/';
                break;
            case 'Operation':
                $path = '/controlled_documents/Operations/';
                break;
            case 'Supply Chain':
                $path = '/controlled_documents/Supply Chain/';
                break;
            default:
                $path = '/controlled_documents/'.trim($request->department_owner).'/';
                break;
        }
        if(!file_exists(public_path($path))){            
            mkdir(public_path($path), 0777, true);            
        }
        if ($request->hasFile('document_file')) {
            $image = $request->file('document_file');
            $new_name = rand(1000, 9999) . '-' . $image->getClientOriginalName();
            $image->move(public_path($path), $new_name);
            $document->document_file =  '/public' . $path . $new_name;
        }

        if ($document->save()) {
            Session::flash('message', 'Document Library has been updated successfully');
            return redirect()->route('document_library.index');
        } else {
            Session::flash('error', 'Document Library not updated successfully');
            return redirect()->route('document_library.index');
        }
    }

    public function status($id)
    {
        $document = DocumentLibrary::where('id', $id)->first();

        if ($document->status == 1) {
            $document->status = 0; //0 for Block
            $document->save();
        } else {
            $document->status = 1; //1 for Unblock
            $document->save();
        }

        if ($document->status == 1) {
            return 1;
        } else {
            return 2;
        }
    }

    public function delete($id)
    {
        $document = DocumentLibrary::find($id);
        $document->delete();
        return redirect()->route('document_library.index');
    }
    public function downloadDoc($docId)
    {
        if (!$docId) {
            Session::flash('error', 'No Document Found');
            return redirect()->back();
        }

        $docs = DocumentLibrary::find($docId);
        if (!$docs) {
            Session::flash('error', 'No Document Found');
            return redirect()->back();
        }

        $headers = array(
            'Content-Type: ' . $docs->file_type,
        );
        $ext = explode('.', $docs->document_file);
        // dd($ext);

        return response()->download($docs->document_file, $docs->document_name . '.' . $ext[sizeof($ext) - 1], $headers);
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
