<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\BoardDirector;
use Session;
use Auth; 
class BoardDirectorController extends Controller
{
   
    public function index()
    {   
        $board_director = BoardDirector::orderBy('id','DESC');
        if(isset($request->name))
		{
            $board_director = $board_director->where('title','LIKE','%'.$request->title.'%');
        }
        $board_director = $board_director->paginate(10);
        return view('Admins.board_directors.index',compact('board_director'))->with('i', 1);
    }

    public function create()
    {
        return view('Admins.board_directors.create');
    
    }

    public function store(Request $request)
    {
        $board_director = new BoardDirector();
        $board_director->name = $request->name;
		$board_director->designation = $request->designation;
		$board_director->institute = $request->institute;
        $board_director->description =$request->description;
        $board_director->name_ar = $request->name_ar;
        $board_director->designation_ar = $request->designation_ar;
        $board_director->institute_ar = $request->institute_ar;
        $board_director->description_ar =$request->description_ar;
		$board_director->sequence_number =$request->sequence_number;
		$board_director->created_by =Auth::user()->id;
		if($request->hasFile('image'))
		{
            $image=$request->file('image');
            $new_name = rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $image-> move(public_path('uploads/board_director'),$new_name);
            $board_director->image = $new_name;
        }  
        if($request->preview){
            $new_rec = $board_director;
            $board_director = BoardDirector::orderBy('sequence_number', 'asc');

            $board_director = $board_director->get();
            // return view('website.board_director', compact('board_director'));
            $isEdit=false;
            $html = view('website.board_director_preview', compact('board_director','new_rec','isEdit'))->render();
             return redirect()->back()->with("preview_page",$html)->withInput();
            }else{
        if($board_director->save())
		{
        
			 Session::flash('message', 'Board Director has been added successfully');
			 return redirect()->route('board_director.index'); 
		}
		else
		{
			Session::flash('error', 'Board Director not added successfully');
			return redirect()->route('board_director.index'); 
		} 
		} 
    }

   
    public function edit($id)
    {
         $board_director = BoardDirector::find($id);
         return view('Admins.board_directors.edit',compact('board_director'));
    }

    public function update(Request $request, $id)
    {
	
        $board_director = BoardDirector::where('id',$id)->first();
        
        $board_director->name = $request->name;
		$board_director->designation = $request->designation;
		$board_director->institute = $request->institute;
        $board_director->description =$request->description;
        $board_director->name_ar = $request->name_ar;
        $board_director->designation_ar = $request->designation_ar;
        $board_director->institute_ar = $request->institute_ar;
        $board_director->description_ar =$request->description_ar;
		$board_director->sequence_number =$request->sequence_number;
		$board_director->updated_by = Auth::user()->id;
		if($request->hasFile('image'))
		{
            $image=$request->file('image');
            $new_name = rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $image-> move(public_path('uploads/board_director'),$new_name);
            $board_director->image = $new_name;
        }    
        if($request->preview){
           
            $new_rec = $board_director;
            $board_director = BoardDirector::orderBy('sequence_number', 'asc');

            $board_director = $board_director->get();
            // return view('website.board_director', compact('board_director'));
            $isEdit=true;
            $html = view('website.board_director_preview', compact('board_director','new_rec','isEdit'))->render();
            // $html="";
             return redirect()->back()->with("preview_page",$html)->withInput();
        }else{
                if($board_director->save())
                {
                
                    Session::flash('message', 'Board Director  has been updated successfully');
                    return redirect()->route('board_director.index');
                }
                else
                {
                    Session::flash('error', 'Board Director  not updated successfully');
                    return redirect()->route('board_director.index');
                }
		}
    }
	
	public function status($id)
    {
        $board_director = BoardDirector::where('id', $id)->first();

        if ($board_director->status == 1)
        {
            $board_director->status = 0; //0 for Block
            $board_director->save();

        }
        else 
		{
			$board_director->status = 1; //1 for Unblock
			$board_director->save();
		}

        if ($board_director->status == 1)
        {
            return 1;
        }
        else
        {
            return 2;
        }
    }

    public function delete($id)
    {
        $board_director = BoardDirector::find($id);
        $board_director->delete();
       return redirect()->route('board_director.index');
       
    }
	
	
}
