<?php

namespace App\Http\Controllers\EmployeePortal;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\MarketPlace;
use App\Story;
use App\InternalApplication;
use App\PMONotice;
use App\Todo;
use App\TeamSalute;
use App\DocumentLibrary;
use App\HeadsUp;


class DashboardController extends Controller
{
    public function index() 
	{		
		try {
			// dd("dashboardcontroller.index");
			$analysis=[];
		//$categories = DB::table('employee_portal_categories')->pluck('name', 'id');
		
		$market_place = MarketPlace::where('status','ACCEPT')->orderBy('created_at', 'desc')->paginate(6);
		$analysis['market_place'] = MarketPlace::where('status','ACCEPT')->orderBy('created_at', 'desc')->get()->count();
		$analysis['market_place_new'] = MarketPlace::where('status','ACCEPT')->whereDate('created_at', Carbon::today())->get()->count();
		
		$internal_applications = InternalApplication::where('selected', 1)->orderBy('created_at', 'desc')->paginate(6);
		// $internal_applications = InternalApplication::orderBy('created_at', 'asc')->paginate(6);
		$analysis['internal_applications'] = InternalApplication::orderBy('created_at', 'desc')->get()->count();
		$analysis['internal_applications_new'] = InternalApplication::whereDate('created_at', Carbon::today())->get()->count();

		$pmo_notices = PMONotice::where('selected', 1)->orderBy('created_at', 'desc')->paginate(9);		
		$analysis['pmo_notices'] = PMONotice::orderBy('created_at', 'desc')->get()->count();
		$analysis['pmo_notices_new'] = PMONotice::whereDate('created_at', Carbon::today())->get()->count();

		

		$document_library = DocumentLibrary::orderBy('created_at', 'desc')->paginate(6);
		$analysis['document_library'] = DocumentLibrary::orderBy('created_at', 'desc')->get()->count();
		$analysis['document_library_new'] = DocumentLibrary::whereDate('created_at', Carbon::today())->get()->count();
		
		$stories = Story::where('status','approved')->orderBy('created_at', 'desc')->paginate(3);
		$analysis['stories'] = Story::where('status','approved')->orderBy('created_at', 'desc')->get()->count();
		$analysis['stories_new'] = Story::where('status','approved')->whereDate('created_at', Carbon::today())->get()->count();
		
		$team_salutes = TeamSalute::orderBy('created_at', 'desc')->paginate(3);
		$analysis['team_salutes'] = TeamSalute::orderBy('created_at', 'desc')->get()->count();
		$analysis['team_salutes_new'] = TeamSalute::whereDate('created_at', Carbon::today())->get()->count();
        
		$heads_up = HeadsUp::orderBy('created_at', 'desc')->paginate(4);
		$heads_up_today = HeadsUp::orderBy('created_at', 'desc')->limit(5)->get();
		// $heads_up_today = HeadsUp::whereDate('created_at', Carbon::today())->get();
		$analysis['heads_up'] = HeadsUp::orderBy('created_at', 'desc')->get()->count();
		$analysis['heads_up_new'] = HeadsUp::orderBy('created_at', 'desc')->limit(5)->get()->count();
		// $analysis['heads_up_new'] = HeadsUp::whereDate('created_at', Carbon::today())->get()->count();
       /**
		 * Todo Section for last week data
		 */
			$today = Carbon::today();
			// $userId = Auth::id();
			// $todos = Todo::where('employee_id', $userId);
			// $todos = $todos->whereWeek('date', '=', $today->format('w'));
			// $todos = Todo::whereWeek('date', '=', $today->format('w'))->get();
			$todos=[];
		/**
		 * Todo end section
		 */
         return view('employee_portal.dashboard',[
			 'internal_applications'=>$internal_applications,
			 'pmo_notices'=>$pmo_notices,
			 'stories'=>$stories,
			 'team_salutes'=>$team_salutes,
			 'heads_up'=>$heads_up,
			 'heads_up_today'=>$heads_up_today,
			 'todos'=>$todos,
			 'market_place'=>$market_place,
			 'analysis'=>$analysis,
			 'document_library'=>$document_library
			]);
		} catch (\Exception $th) {
			//throw $th;
	dd($th);
	return response()->back();

		}
     }
	
	 public function document_library()
	 {
	 	return view('employee_portal.document_library');
	 }
	 
	 public function market_place()
	 {
		$data=MarketPlace::orderBy('created_at','desc')->paginate(8);
	 	return view('employee_portal.market_place')->with(compact('data'));
	 }
	 public function create()
	 {
		$data=MarketPlace::orderBy('created_at','desc')->paginate(8);
	 	return view('employee_portal.market_place')->with(compact('data'));
	 }
}