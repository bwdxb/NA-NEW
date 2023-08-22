<?php

namespace App\Http\Controllers\EmployeePortal;

use App\PMONotice;
use App\PMONoticeDocuments;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;


class PMONoticeBoardController extends Controller
{

    /*
     * todo (Employee Middleware): authenticate loggedin user trying to access the MarketPlace features are of type/role Employee
     * todo <Note : particularly Department Heads or C-Levels>
     * */



    public function fetch(Request $request)
    {
        $id = $_GET['id'];
        
        if (!$id) {
            Session::flash('error', 'Failed to get the PMO Notice');
            return redirect()->back();
        }

        $docs = PMONotice::find($id);
        if (!$docs) {
            Session::flash('error', 'Failed to get the PMO Notice');
            return redirect()->back();
        }

        // Session::flash('success', 'Successfully get the Document');
        $data = PMONoticeDocuments::where('pmo_id',$id);
        if(isset($request->search_key))
         {
            $data = $data->where('document','LIKE','%'.$request->search_key.'%');
         }
         $data = $data->orderBy('created_at', 'desc')->paginate(8);
        // dd($docs);
        return view('employee_portal.employee_pmo_notice', ['update' => $docs, 'data' => $data]);
        // return view('employee_portal.document_library', ['data' => $docs]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'op_type' => 'required|in:create,update',
            'controlled_number' => 'sometimes|required_if:op_type,==,create',
            'document_issue_date' => 'sometimes|required_if:op_type,==,create',
            'document_name' => 'sometimes|required_if:op_type,==,create',
//            'document_version_number' => 'sometimes|required_if:op_type,==,create',
            'document_version_number' => 'sometimes',
            'department_owner' => 'sometimes|required_if:op_type,==,create',
            'document_type' => 'sometimes|required_if:op_type,==,create',
            'data_classification' => 'sometimes',
            'document_file' => 'sometimes|required_if:op_type,==,create',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Failed to upload the Document');
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            // $file_type = explode('/', $file->getMimeType())[0];
            $file_type = $file->getMimeType();
            $file_size = $this->formatSizeUnits($file->getSize());
            // dd([
            //     'file type'=>$file_type,
            //     'file size'=>$file_size,
            // ]);

            $file_name = rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/doc_lib'), $file_name);
            $file_url = 'public/uploads/doc_lib/' . $file_name;
        }

        if ($request->op_type == 'create') {

            $docs = DocumentLibrary::create($request->all() + [
                'document_file_url' => $file_url,
                'document_file_type' => $file_type . '',
                'document_file_size' => $file_size,
                'created_by' => Auth::id(),
//                    'created_by' => 1,
            ]
        );


            if ($docs) {
                Session::flash('success', 'Document has been added successfully');
                return redirect()->back();
            } else {
                Session::flash('error', 'Failed to upload the Document');
                return redirect()->back()->withInput();
            }
        } else {
            if (!isset($request->id)) {
                Session::flash('error', 'Failed to update the Document');
                return redirect()->back()->withInput();
            }

            $docs = DocumentLibrary::find($request->id);
            // dd($docs);
            if (!$docs) {
                Session::flash('error', 'Failed to update the Document');
                return redirect()->back()->withInput();
            }
            // dd($request->all());
            $data = $request->all();
            if (isset($file_url)) {
                $data['document_file_url'] = $file_url;
                $data['document_file_type'] = $file_type;
                $data['document_file_size'] = $file_size;
            }

            $update = $docs->update($data);
            // dd([$docs->refresh()]);
            if ($update) {
                Session::flash('success', 'Successfully updated the Document');
                return redirect()->route('employee-portal.document-library.admin.view');
            } else {
                Session::flash('error', 'Failed to update the Document');
                return redirect()->back()->withInput();
            }
        }
    }

    public function view($id)
    {

        if (!$id) {
            Session::flash('error', 'Failed to get the PMO Notice');
            return redirect()->back();
        }

        $docs = PMONotice::find($id);
        if (!$docs) {
            Session::flash('error', 'Failed to get the PMO Notice');
            return redirect()->back();
        }

        // Session::flash('success', 'Successfully get the Document');
        $data = PMONoticeDocuments::orderBy('created_at', 'desc')->paginate(8);
        // dd($docs);
        return view('employee_portal.pmo_notice', ['update' => $docs, 'data' => $data]);
        // return view('employee_portal.document_library', ['data' => $docs]);
    }

    

    public function delete($id)
    {
        if (!$id) {
            Session::flash('error', 'Failed to delete the Document');
            return redirect()->back();
        }

        $docs = DocumentLibrary::find($id);
        if (!$docs) {
            Session::flash('error', 'Failed to delete the Document');
            return redirect()->back();
        }

        $delete = $docs->delete();

        if ($delete) {
            Session::flash('success', 'Successfully deleted the Document');
        } else {
            Session::flash('error', 'Failed to delete the Document');
        }
        return redirect()->route('employee-portal.document-library.view');
    }

    public function filter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department' => 'required',
            'doctype' => 'required',
            'sort' => 'required',
        ]);


        if ($validator->fails()) {
            Session::flash('error', 'Failed to fetch filtered Documents');
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }
// dd($request->all());

        $docs = DocumentLibrary::query();

        if (isset($request->filter_date)) {
            // dd( (new Carbon($request->filter_date))->startOfDay());
            // $docs = $docs->whereBetween('created_at', [(new Carbon($request->filter_date))->startOfDay(), (new Carbon($request->filter_date))->endOfDay()]);
             $docs = $docs->whereBetween('created_at', [(new Carbon($request->filter_date))->startOfDay(), (new Carbon($request->filter_date))->endOfDay()])
            ->orWhereDate('document_issue_date', '=', new Carbon($request->filter_date));
        }

        if ($request->department == 'all' && $request->doctype == 'all') {
            $docs = $docs->inRandomOrder();
        } else {
            switch ($request->department) {
                case 'all':
                $docs = $docs->inRandomOrder();
                break;
                default:
                $docs = $docs->where('department_owner', $request->department);
            }
            // dd([
            //     'request' => $request->all(),
            //     'query' => $docs->toSql(),
            //     'data' => $docs->get(),
            // ]);
            switch ($request->doctype) {
                case 'all':
                $docs = $docs->inRandomOrder();
                break;
                default:
                $docs = $docs->where('document_type', $request->doctype);
            }

            // dd($docs->get());

            if ($request->department != 'all') {
                $docs = $docs->groupby('created_at', 'department_owner');
            }

            if ($request->doctype != 'all') {
                $docs = $docs->groupby('created_at', 'document_type');
            }
        }

        // if (isset($request->filter_date)) {
        //     // dd( (new Carbon($request->filter_date))->startOfDay());
        //     // $docs = $docs->whereBetween('created_at', [(new Carbon($request->filter_date))->startOfDay(), (new Carbon($request->filter_date))->endOfDay()]);
        //      $docs = $docs->whereBetween('created_at', [(new Carbon($request->filter_date))->startOfDay(), (new Carbon($request->filter_date))->endOfDay()])
        //     ->orWhereDate('document_issue_date', '=', new Carbon($request->filter_date)));
        // }
        switch ($request->sort) {
            case 'latest':
            $docs = $docs->latest();
            break;
            default:
            $docs = $docs->oldest();
        }

        // dd($docss->toSql());
        $docs = $docs->get();

        // Session::flash('success', 'Successfully retrieved filtered Documents');
        return view('employee_portal.employee_document_library', ['data' => $docs, "filter" => $request->all()]);
    }

    public function adminFilter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department' => 'required',
            'doctype' => 'required',
            'sort' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Failed to fetch filtered Documents');
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }

        $docs = DocumentLibrary::query();

        if (isset($request->filter_date)) {
            // dd( (new Carbon($request->filter_date))->startOfDay());
            // $docs = $docs->whereBetween('created_at', [(new Carbon($request->filter_date))->startOfDay(), (new Carbon($request->filter_date))->endOfDay()]);
             $docs = $docs->whereBetween('created_at', [(new Carbon($request->filter_date))->startOfDay(), (new Carbon($request->filter_date))->endOfDay()])
            ->orWhereDate('document_issue_date', '=', new Carbon($request->filter_date));
        }

        if ($request->department == 'all' && $request->department == 'all') {
            $docs = $docs->inRandomOrder();
        } else {
            switch ($request->department) {
                case 'all':
                $docs = $docs->inRandomOrder();
                break;
                default:
                $docs = $docs->where('department_owner', $request->department);
            }

            switch ($request->doctype) {
                case 'all':
                $docs = $docs->inRandomOrder();
                break;
                default:
                $docs = $docs->where('document_type', $request->doctype);
            }
            // dd($docs->get());

            if ($request->department != 'all') {
                $docs = $docs->groupby('created_at', 'department_owner');
            }

            if ($request->doctype != 'all') {
                $docs = $docs->groupby('created_at', 'document_type');
            }
        }


        switch ($request->sort) {
            case 'latest':
            $docs = $docs->latest();
            break;
            default:
            $docs = $docs->oldest();
        }

        // dd($docss->toSql());
        $docs = $docs->get();

        // Session::flash('success', 'Successfully retrieved filtered Documents');
        return view('employee_portal.document_library', ['data' => $docs, "filter" => $request->all()]);
    }

    public function downloadDoc($docId)
    {
        if (!$docId) {
            Session::flash('error', 'Failed to delete the Document');
            return redirect()->back();
        }

        $docs = DocumentLibrary::find($docId);
        if (!$docs) {
            Session::flash('error', 'Failed to delete the Document');
            return redirect()->back();
        }

        $headers = array(
            'Content-Type: ' . $docs->document_file_type,
        );
        $ext = explode('.', $docs->document_file_url);
        // dd($ext);

        return response()->download($docs->document_file_url, $docs->document_name . '.' . $ext[sizeof($ext) - 1], $headers);
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