<?php

namespace App\Http\Controllers\EmployeePortal;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\UtilTrait;
use App\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;


class TodoController extends Controller
{
    use UtilTrait;

    /*
     * todo (Employee Middleware): authenticate loggedin user trying to access the todo features are of type/role Employee
     * */
//    public function fetch($type = 'daily', $status = 'all', $sort = 'asc', $sortKey = 'date-time')
//    {
//
//    //https://www.digitalocean.com/community/tutorials/easier-datetime-in-laravel-and-php-with-carbon
//        try {
//            $today = Carbon::today();
//            $userId = Auth::id();
//
////            $today->addMonths(2)->subDays(3);
////            $todos = Todo::query();
//
//            $todos = Todo::where('employee_id', $userId);
//            if ($status != 'all') {
//                $todos = $todos->where('status', $status);
//            }
//
//            switch ($type) {
//                case 'daily' :
//                    $todos = $todos->whereDay('date', '=', $today->format('d'));
////                    $todos = $todos->whereDay('date', '=', $today->day);
////                    $todos = $todos->whereDay('date', '=', $today);
////                    $todos = $todos->where('date', $type);
////                    $todos = $todos->whereBetween('date', [$start, $end])
//                    break;
//                case 'weekly' :
//                    $todos = $todos->whereWeek('date', '=', $today->format('w'));
////                    $todos = $todos->whereWeek('date', '=', $today->week);
//                    break;
//                case 'monthly' :
//                    $todos = $todos->whereMonth('date', '=', $today->format('m'));
////                    $todos = $todos->whereMonth('date', '=', $today->month);
//                    break;
//                case 'yearly' :
//                    $todos = $todos->whereYear('date', '=', $today->format('Y'));
////                    $todos = $todos->whereYear('date', '=', $today->year);
//                    break;
//                default:
//            }
//            if ($sortKey === 'date-time') {
//                $todos = $todos->groupby('date', 'time')
//                    ->orderBy('date', $sort);
//            } else {
//                $todos = $todos->orderBy($sortKey, $sort);
//            }
//
//            $todos = $todos->get();
////            $todos = $todos->paginate();
//
//            return response()->json(array(
//                'data' => $todos,
//                'response_code' => 200,
//                'response_message' => 'Successfully feteched ' . $type . ' Todos',
//            ));
//
//        } catch (\Exception $ex) {
//            $this->exceptionLog($ex);
//            return response()->json([
//                'data' => $ex->getMessage(),
//                'response_code' => 500,
//                'response_message' => 'internal server error',
//            ]);
//        }
//    }


//    public function fetch($type = 'weekly')
//    {
//
//        //https://www.digitalocean.com/community/tutorials/easier-datetime-in-laravel-and-php-with-carbon
//        try {
//            $today = Carbon::today();
//            $userId = Auth::id();
//
////            $today->addMonths(2)->subDays(3);
////            $todos = Todo::query();
//
////            $todos = Todo::where('employee_id', $userId);
//            $todos = Todo::where('employee_id', 1);
//
//            switch ($type) {
//                case 'weekly' :
//                    $startDate = $today->startOfWeek()->format('Y-m-d');
//                    $endDate = $today->endOfWeek()->format('Y-m-d');
//                    $todos = $todos->whereBetween('created_at', [$startDate, $endDate])
//                        ->groupby('status', 'updated_at', 'created_at')
//                        ->orderBy('status', 'desc');
//                    break;
//                default:
//                    $todos = $todos->groupby('updated_at', 'status', 'created_at')
//                        ->orderBy('status', 'asc');
//            }
//
//            $todos = $todos->get();
//
//            return response()->json(array(
//                'data' => $todos,
//                'response_code' => 200,
//                'response_message' => 'Successfully feteched ' . $type . ' Todos',
//            ));
//
//        } catch (\Exception $ex) {
//            $this->exceptionLog($ex);
//            return response()->json([
//                'data' => $ex->getMessage(),
//                'response_code' => 500,
//                'response_message' => 'internal server error',
//            ]);
//        }
//    }

    public function fetch()
    {
        try {
            $today = Carbon::now();
            $userId = Auth::id();
            if (!$userId) {
                $userId = 1;
            }

//            $today->addMonths(2)->subDays(3);
//            $todos = Todo::query();

//            $todos = Todo::where('employee_id', $userId)->groupby('updated_at', 'status', 'created_at')
//                ->orderBy('status', 'asc')->get();
            // return response()->json([
            //     'date' => $today,
            //     'week 1st' => $today->startOfWeek()->format('Y-m-d'),
            //     'week 2nd' => $today->endOfWeek(),
            // ]);
            $todos = Todo::where('employee_id', $userId)
                ->whereBetween('date', [$today->startOfWeek()->format('Y-m-d'), $today->endOfWeek()->format('Y-m-d')])
                // ->groupby('updated_at', 'status', 'created_at')
                ->orderBy('status', 'asc')
                ->get();

            return response()->json(array(
                'data' => $todos,
                'response_code' => 200,
                'response_message' => '',
            ));

        } catch (\Exception $ex) {
            $this->exceptionLog($ex);
            return response()->json([
                'data' => $ex->getMessage(),
                'response_code' => 500,
                'response_message' => 'internal server error',
            ]);
        }
    }

    public function fetchAll()
    {
        try {
            $userId = Auth::id();
            if (!$userId) {
                $userId = 1;
            }
            $data = Todo::where('employee_id', $userId)
                // ->groupby('updated_at', 'status', 'created_at')
                ->orderBy('status', 'asc')
                ->get();

            return response()->json(array(
                'data' => $data,
                'response_code' => 200,
                'response_message' => '',
            ));

        } catch (\Exception $ex) {
            $this->exceptionLog($ex);
            return response()->json([
                'data' => $ex->getMessage(),
                'response_code' => 500,
                'response_message' => 'internal server error',
            ]);
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'todo' => 'required',
//            'date' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                'data' => $validator,
                'response_code' => 400,
                'response_message' => 'Failed to add Todo, validation error!!!',
            ));
        }

        try {
            $todo = Todo::create($request->all() + [
                    'employee_id' => Auth::id(),
//                    'employee_id' => 1,
//                    'date' => (isset($request->date)) ? $request->date : Carbon::today(),
                ]
            );

            if (!$todo) {
                return response()->json(array(
                    'data' => $request->all(),
                    'response_code' => 400,
                    'response_message' => 'Failed to add Todo',
                ));
            }
            return response()->json(array(
                'data' => $todo,
                'response_code' => 200,
                'response_message' => 'Successfully added Todo',
            ));

        } catch (\Exception $ex) {
            $this->exceptionLog($ex);
            return response()->json([
                'data' => $ex->getMessage(),
                'response_code' => 500,
                'response_message' => 'internal server error',
            ]);
        }
    }

    public function update($id)
    {
        if (!$id) {
            return response()->json(array(
                'response_code' => 400,
                'response_message' => 'Failed to update Todo',
            ));
        }

        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json(array(
                'response_code' => 400,
                'response_message' => 'Failed to update Todo',
            ));
        }

        $update = $todo->update([
            'status' => ($todo->status == 'pending') ? 'completed' : 'pending',
        ]);

        if ($update) {
            return response()->json(array(
                'response_code' => 200,
                'response_message' => 'Successfully updated Todo',
            ));
        } else {
            return response()->json(array(
                'response_code' => 400,
                'response_message' => 'Failed to update Todo',
            ));
        }
    }

    public function delete($id)
    {
        if (!$id) {
            return response()->json(array(
                'response_code' => 400,
                'response_message' => 'Failed to delete Todo',
            ));
        }

        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json(array(
                'response_code' => 400,
                'response_message' => 'Failed to delete Todo',
            ));
        }

        $delete = $todo->delete();

        if ($delete) {
            return response()->json(array(
                'response_code' => 200,
                'response_message' => 'Successfully deleted Todo',
            ));
        } else {
            return response()->json(array(
                'response_code' => 400,
                'response_message' => 'Failed to delete Todo',
            ));
        }
    }
}