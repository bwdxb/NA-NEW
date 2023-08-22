<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\PMONotice;
use App\PMONoticeDocuments;
use App\Menu;
use Session;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use File;

use app\Http\helper\Helper as Helper;

class PMONoticeBoardController extends Controller
{

    public function index(Request $request)
    {
        Helper::checkUserSession();
        Helper::checkPagePermission('VW_CMS', 'view', session('userRoleIDs'));
        $pmodata = DB::table('pmo_notice');
        
        if (isset($request->search_key)) {
            $pmodata = $pmodata->where('title', 'LIKE', '%' . $request->search_key . '%');
        }
        
        if (isset($request->sort) && $request->sort == 'ASC') {

            $pmodata = $pmodata->orderBy('id', 'ASC');
        } else {
            $pmodata = $pmodata->orderBy('id', 'DESC');
        }

        $pmodata = $pmodata->Paginate(10);

        // $pmodata = $pmodata->select('document_type.type as document_type', 'document_library.*')->orderBy('id', 'DESC')->Paginate(10);

        return view('Admins.pmo_notice_board.index', compact('pmodata'))->with('i', 1);
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

        return view('Admins.pmo_notice_board.index', compact('documents', 'document_type'))->with('i', 1);
    }

    public function create()
    {
        Helper::checkUserSession();
        Helper::checkPagePermission('CR_CMS', 'view', session('userRoleIDs'));
        $document_type = DB::table('document_type')->pluck('type', 'id');

        return view('Admins.pmo_notice_board.create', compact('document_type'));
    }

    public function store(Request $request)
    {
        $dt = Carbon::now();
        $dt->year = $request->year;
        $dt->month = $request->month;
        $dt->day = 1;
        $document = new PMONotice();        
        $document->title = $request->title;
        $document->created_by = Auth::user()->id;
        $path='uploads/pmo/';
        
        if ($request->hasFile('cover_img')) {

            $image = $request->file('cover_img');
            $file_type = $image->getMimeType();
            $file_size = $this->formatSizeUnits($image->getSize());
            $new_name = rand(1000, 9999) . '.' . $image->getClientOriginalName();
            $image->move(public_path($path), $new_name);
            $document->cover_img =  $new_name;
        }
        if ($request->hasFile('banner_img')) {

            $image = $request->file('banner_img');
            $file_type = $image->getMimeType();
            $file_size = $this->formatSizeUnits($image->getSize());
            $new_name = rand(1000, 9999) . '.' . $image->getClientOriginalName();
            $image->move(public_path($path), $new_name);
            $document->banner_img =  $new_name;
        }
        if ($document->save()) {

            if($request->hasfile('filenames'))
            {
                foreach($request->file('filenames') as $file)
                {
                    //$name = time().'-'.rand(1000,9999).'.'.$file->extension();
                    $name = $file->getClientOriginalName();
                    $media_type = explode('/', $file->getMimeType())[0];                    
                    
                    $file->move(public_path('uploads/pmo'),$name);
                    $img = new PMONoticeDocuments();
                    $img->pmo_id = $document->id;
                    $img->document = $name;
                    $img->created_by = Auth::user()->id;
                    $img->save();  
                }                 
             }

            Session::flash('message', 'PMO Notice has been added successfully');
            return redirect()->route('pmo_notice_board.index');
        } else {
            Session::flash('error', 'PMO Notice not added successfully');
            return redirect()->route('pmo_notice_board.index');
        }
    }
    
    public function edit($id)
    {
        $document = PMONotice::find($id);
        $documents = PMONoticeDocuments::where('pmo_id',$id)->get();

        return view('Admins.pmo_notice_board.edit', compact('document','documents'));
    }

    public function update(Request $request, $id)
    {
        $dt = Carbon::now();
        $dt->year = $request->year;
        $dt->month = $request->month;
        $dt->day = 1;
        $document = PMONotice::where('id', $id)->first();
        $document->title = $request->title;        
        $document->updated_by = Auth::user()->id;
        $path='uploads/pmo/';
        
        if ($request->hasFile('cover_img')) {

            $image = $request->file('cover_img');
            $file_type = $image->getMimeType();
            $file_size = $this->formatSizeUnits($image->getSize());
            $new_name = rand(1000, 9999) . '.' . $image->getClientOriginalName();
            $image->move(public_path($path), $new_name);
            if(File::exists(public_path($path).$document->cover_img)) {
                unlink(public_path($path).$document->cover_img);
            }
            $document->cover_img =  $new_name;
        }
        if ($request->hasFile('banner_img')) {

            $image = $request->file('banner_img');
            $file_type = $image->getMimeType();
            $file_size = $this->formatSizeUnits($image->getSize());
            $new_name = rand(1000, 9999) . '.' . $image->getClientOriginalName();
            $image->move(public_path($path), $new_name);
            if(File::exists(public_path($path).$document->banner_img)) {
                unlink(public_path($path).$document->banner_img);
            }
            $document->banner_img =  $new_name;
        }

        if ($document->save()) {
            if($request->hasfile('filenames'))
            {
                foreach($request->file('filenames') as $file)
                {
                    //$name = time().'-'.rand(1000,9999).'.'.$file->extension();
                    $name = $file->getClientOriginalName();
                    $media_type = explode('/', $file->getMimeType())[0];                    
                    
                    $file->move(public_path('uploads/pmo'),$name);
                    $img = new PMONoticeDocuments();
                    $img->pmo_id = $document->id;
                    $img->document = $name;
                    $img->created_by = Auth::user()->id;
                    $img->save();  
                }                 
            }
            Session::flash('message', 'PMO Notice has been updated successfully');
            return redirect()->route('pmo_notice_board.index');
        } else {
            Session::flash('error', 'PMO Notice not updated successfully');
            return redirect()->route('pmo_notice_board.index');
        }
    }
    public function updateDashboard(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'app_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }
        $app_ids = $request->app_ids;
        $totCount = count($app_ids);

        while (in_array(0, $app_ids)) {
            $pos = array_search(0, $app_ids);// Search for value 0
            unset($app_ids[$pos]);// Remove 0 from $userPackages
        }
        $trueCount = count($app_ids);
        $falseCount = $totCount - $trueCount;

        $apps = PMONotice::whereIn('id',$app_ids)
        ->update([
            'selected' => 1
        ]);
        if ($apps != $trueCount) {
            Session::flash('error', 'Failed to update records');
            return redirect()->back();
        }

        $apps = PMONotice::whereNotIn('id',$app_ids)
        ->update([
            'selected' => 0
        ]);
        if ($apps != $falseCount) {
            Session::flash('error', 'Failed to update records');
            return redirect()->back();
        }

        Session::flash('success', 'Updated records successfully');
        return redirect()->back();
    }

    public function status($id)
    {
        $document = PMONotice::where('id', $id)->first();

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
        $document = PMONotice::find($id);
        $document->delete();
        return redirect()->route('pmo_notice_board.index');
    }

    public function deletedoc($id)
    {
        $document = PMONoticeDocuments::find($id);
        $document->delete();
    }

    public function downloadDoc($docId)
    {
        if (!$docId) {
            Session::flash('error', 'No Document Found');
            return redirect()->back();
        }

        $docs = PMONotice::find($docId);
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
