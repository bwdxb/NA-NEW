<?php

namespace App\Http\Controllers\EmployeePortal;

use App\Http\Controllers\Controller;
use App\Story;
use App\StoryLike;
use App\StoryView;
use App\User;
use App\StoryCategory;
use App\Notification;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Mail;
use Image;
use Log;



class StoryController extends Controller
{

    /*
     * todo (Employee Middleware): authenticate loggedin user trying to access the MarketPlace features are of type/role Employee
     * */
    public function adminFetch(Request $request)
    {
        try {

            $data = Story::query();


            if (isset($request->filter)) {
                if ($request->filter === 'all') {
                    $data = $data->where('status', 'approved');

                    switch ($request->sort) {
                        case 'latest':
                            $data = $data->groupby('created_at')->latest();
                            break;
                        default:
                            $data = $data->groupby('created_at')->oldest();
                    }
                } else {
                    $filterCategory = explode('-', $request->filter);



                    switch ($filterCategory[0]) {
                        case 'all':
                            // $data = $data->latest();
                            break;
                        default:
                            $data = $data->where($filterCategory[1], $filterCategory[0]);
                    }
                }
            }
            if (isset($request->search)) {
                $data = $data->where("title", "LIKE", trim($request->search) . "%");
            }
            if (isset($request->year)) {
                $data = $data->whereYear("created_at", (int)$request->year);
            }
            if (isset($request->month)) {
                $data = $data->whereMonth("created_at", (int)$request->month);
            }
            if (isset($request->sort)) {
                switch ($request->sort) {
                    case 'latest':
                        $data = $data->latest();
                        break;
                    default:
                        $data = $data->oldest();
                }
            } else {
                $data = $data->latest();
            }
            // dd($data->toSql());
            // $data = $data->get();

            $data = $data->paginate(8);
            // $data=$data->where('status', 'approved')->paginate(8);
            return view('employee_portal.admin_story', ['data' => $data]);
        } catch (\Exception $ex) {
            Log::error($ex);
        }
    }
    public function fetch(Request $request)
    {

        $data = Story::query();


        if (isset($request->filter)) {
            if ($request->filter === 'all') {
                $data = $data->where('status', 'approved');

                switch ($request->sort) {
                    case 'latest':
                        $data = $data->groupby('created_at')->latest();
                        break;
                    default:
                        $data = $data->groupby('created_at')->oldest();
                }
            } else {
                $filterCategory = explode('-', $request->filter);



                switch ($filterCategory[0]) {
                    case 'all':
                        // $data = $data->latest();
                        break;
                    default:
                        $data = $data->where($filterCategory[1], $filterCategory[0]);
                }
            }
        }
        if (isset($request->search)) {
            $data = $data->where("title", "LIKE", trim($request->search) . "%");
        }
        if (isset($request->year)) {
            $data = $data->whereYear("created_at", (int)$request->year);
        }
        if (isset($request->month)) {
            $data = $data->whereMonth("created_at", (int)$request->month);
        }
        if (isset($request->sort)) {
            switch ($request->sort) {
                case 'latest':
                    $data = $data->latest();
                    break;
                default:
                    $data = $data->oldest();
            }
        } else {
            $data = $data->latest();
        }
        // dd($data->toSql());
        // $data = $data->get();

        $data = $data->where(function ($query) {
            $query->where('status', 'approved')
                ->orWhere('created_by', Auth::user()->id);
        })->paginate(8);
        // $data=$data->where('status', 'approved')->paginate(8);
        return view('employee_portal.story_board', ['data' => $data]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'sometimes',
            'title' => 'required',
            'category' => 'required',
            'story' => 'required',
            'accept_terms' => 'required',
            'file' => 'required_without:id|mimes:jpg,jpeg,png,bmp,mp4,mov,oga,ogv,ogg,webm',
            'file_credits' => 'sometimes',
            'dont_publish_name_status' => 'sometimes', //accepted->for always to be checked
        ],
        ['accept_terms.required' => 'Please select the checkbox for Terms and Conditions.',
        'file.required_without'=>'Please upload a file']);

        if ($validator->fails()) {
            //Session::flash('error', 'Failed to create story');
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $media_type = '';
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $media_type = explode('/', $file->getMimeType())[0];
            if ($media_type == 'image') {
                $img = Image::make($file->path());
                // $img = $img->encode('webp', 75);  // 75 is image quality and its value can be 1 to 100
                $img->resize(450, 350, function ($constraint) {
                    $constraint->aspectRatio();
                }); // compression with aspectratio
                $file_url = 'public/uploads/story/' . $file_name;
                $img->save($file_url, 75);
            } else {
                $file->move(public_path('uploads/story'), $file_name);
                $file_url = 'public/uploads/story/' . $file_name;
            }
        }

        if ($request->id) {
            $story = Story::find($request->id);
            if (!$story) {
                Session::flash('error', 'Failed to update Story');
                return redirect()->back()->withInput();
            }
            $data = $request->all();
            if(isset($data['dont_publish_name_status']))
            {
                if ($data['dont_publish_name_status'] == 'on') {
                    $data['dont_publish_name_status'] = 1;
                } else {
                    $data['dont_publish_name_status'] = 0;
                }
            }else{
                $data['dont_publish_name_status'] = 0;
            }
            //echo '<pre>';print_r($data);exit;
            if (isset($file_url)) {
                $data['file_url'] = $file_url;
            }

            if ($media_type !== '') {
                $data['media_type'] = $media_type;
            }
            $data['status'] = "pending";

            $update = $story->update($data);

            if ($update) {
                Session::flash('title_msg', 'Thank You.');
                Session::flash('success', 'Your story has been submitted for review and approval. We will get in touch with you if further information is required.');
                return redirect('/employee-portal/story');
            } else {
                Session::flash('error', 'Failed to update the story');
                return redirect()->back()->withInput();
            }
        } else {
            $data = $request->all();
            if (isset($data['dont_publish_name_status']) && $data['dont_publish_name_status'] == 'on') {
                $data['dont_publish_name_status'] = 1;
            } else {
                $data['dont_publish_name_status'] = 0;
            }
            $story = Story::create(
                $data + [
                    'media_type' => $media_type,
                    'file_url' => $file_url,
                    'created_by' => Auth::id(),
                    //                'created_by' => 1,
                ]
            );

            if ($story) {
                Session::flash('title_msg', 'Thank You.');
                Session::flash('success', 'Your story has been submitted for review and approval. We will get in touch with you if further information is required.');
                return redirect('/employee-portal/story');
            } else {
                Session::flash('error', 'Failed to create story');
                return redirect()->back()->withInput();
            }
        }
    }

    public function filter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filter' => 'required',
            'sort' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Failed to fetch filtered stories');
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $stories = Story::query();

        // if ($request->search) {
        //     $stories = $stories->where('story', 'like', "%{$request->search}%");
        // }
        // $stories = $stories->groupby('created_at', $filterCategory[1])
        if ($request->filter === 'all') {
            $stories = $stories->where('status', 'approved');

            switch ($request->sort) {
                case 'latest':
                    $stories = $stories->groupby('created_at')->latest();
                    break;
                default:
                    $stories = $stories->groupby('created_at')->oldest();
            }
        } else {
            $filterCategory = explode('-', $request->filter);

            $stories = $stories->where('created_by', Auth::id());

            if (isset($request->year)) {
                $stories = $stories->whereYear("created_at", $request->year);
            }
            if (isset($request->month)) {
                $stories = $stories->whereMonth("created_at", $request->month);
            }
            switch ($filterCategory[0]) {
                case 'all':
                    // $stories = $stories->latest();
                    break;
                default:
                    $stories = $stories->where($filterCategory[1], $filterCategory[0]);
            }

            switch ($request->sort) {
                case 'latest':
                    $stories = $stories->groupby('created_at', $filterCategory[1])->latest();
                    break;
                default:
                    $stories = $stories->groupby('created_at', $filterCategory[1])->oldest();
            }
        }
        // dd($stories->toSql());
        // $stories = $stories->get();

        $stories = $stories->paginate(8);

        // Session::flash('success', 'Successfully retrieved filtered stories');
        return view('employee_portal.story_board', ['data' => $stories, 'filter' => $request->all()]);
    }


    //    public function updateStoryAttribute(Request $request, $attribute = 'status', $value = 'approved')
    //    {
    //        $validator = Validator::make(
    //            $request->all() + [
    //                'attribute' => $attribute,
    //                'value' => $value,
    //            ], [
    //            'id' => 'required',
    //            'attribute' => 'required|in:status,like_count,dislike_count,view_count',
    //            'value' => 'required',  //in_array:anotherfield.*
    //        ]);
    //        if ($validator->fails()) {
    //            return response()->json(array(
    //                'data' => $validator,
    //                'response_code' => 400,
    //                'response_message' => 'Failed to update the Story',
    //            ));
    //        }
    //
    //        $story = Story::find($request->id);
    //        if (!$story) {
    //            return response()->json(array(
    //                'data' => $request->all() + [
    //                        'attribute' => $attribute,
    //                        'value' => $value,
    //                    ],
    //                'response_code' => 400,
    //                'response_message' => 'Failed to update the Story',
    //            ));
    //        }
    //
    //        $update = null;
    //        switch ($attribute) {
    //            case 'status':
    //                if (!in_array($value, ['approved', 'rejected'])) {
    //                    return response()->json(array(
    //                        'data' => $request->all() + [
    //                                'attribute' => $attribute,
    //                                'value' => $value,
    //                            ],
    //                        'response_code' => 400,
    //                        'response_message' => 'Failed to update the Story',
    //                    ));
    //                }
    //                $update = $story->update([
    //                    $attribute => $value
    //                ]);
    //                break;
    //
    //            default:
    //                if (!in_array($value, ['increment', 'decrement'])) {
    //                    return response()->json(array(
    //                        'data' => $request->all() + [
    //                                'attribute' => $attribute,
    //                                'value' => $value,
    //                            ],
    //                        'response_code' => 400,
    //                        'response_message' => 'Failed to update the Story',
    //                    ));
    //                }
    //
    //                switch ($value) {
    //                    case 'increment':
    ////                        $story->increment($attribute);
    //                        $update = $story->update([
    //                            $attribute => ($story->$attribute + 1)
    //                        ]);
    //                        break;
    //
    //                    default:
    //                        if ($attribute === 'view_count') {
    //                            return response()->json(array(
    //                                'data' => $request->all() + [
    //                                        'attribute' => $attribute,
    //                                        'value' => $value,
    //                                    ],
    //                                'response_code' => 400,
    //                                'response_message' => 'Failed to update the Story',
    //                            ));
    //                        }
    ////                        $story->decrement($attribute);
    //                        $update = $story->update([
    //                            $attribute => ($story->$attribute - 1)
    //                        ]);
    //                }
    //        }
    //
    //
    //        if ($update) {
    //            $story = $story->fresh();
    //            return response()->json(array(
    //                'data' => $story->$attribute,
    //                'response_code' => 200,
    //                'response_message' => 'Successfully updated the Story',
    //            ));
    //        } else {
    //            return response()->json(array(
    //                'data' => $request->all() + [
    //                        'attribute' => $attribute,
    //                        'value' => $value,
    //                    ],
    //                'response_code' => 400,
    //                'response_message' => 'Failed to update the Story',
    //            ));
    //        }
    //    }

    public function updateStoryAttribute($attribute = 'view_count', $id)
    {
        try {
            if (!$id) {
                return response()->json(array(
                    'response_code' => 400,
                    'response_message' => 'Failed to update Story1',
                ));
            }
            $story = Story::find($id);
            if (!$story) {
                return response()->json(array(
                    'response_code' => 400,
                    'response_message' => 'Failed to update Story2',
                ));
            }

            $update = null;
            switch ($attribute) {
                case 'view_count':
                    $isLiked = StoryView::where('story_id', $story->id)->where('created_by', Auth::user()->id)->first();
                    if (!$isLiked) {
                        $storyView = StoryView::create(['created_by' => Auth::user()->id, 'story_id' => $story->id]);
                        $storyView->save();
                        $update = $story->increment($attribute);
                    }
                    break;
                case 'status':
                    $status = ($story->status == 'pending') ? 'approved' : 'pending';
                    $update = $story->update([
                        $attribute => $status
                    ]);
                    // if($story->status == 'pending'){
                    //     $createdUser =User::find($story->created_by);
                    //     $notificationData = new Notification();
                    //     $notificationData->title="Story";
                    //     $notificationData->type="story";
                    //     $notificationData->created_by=Auth::id();
                    //     $notificationData->seen_by=$story->created_by.",";
                    //     $notificationData->description="You have a new story from ".($createdUser->first_name." ".$createdUser->last_name);
                    //     $notificationData->url='/employee-portal/story';
                    //     $notificationData->save();

                    //     /** for accepted alert to posted user */
                    //     $notificationForStory = new Notification();
                    //     $notificationForStory->title="Story approved";
                    //     $notificationForStory->type="story";
                    //     $notificationForStory->created_by=Auth::id();
                    //     $notificationData->send_to=$story->created_by.",";
                    //     $notificationForStory->description="Hi ".($createdUser->first_name." ".$createdUser->last_name).". Your story (".$story->title.") has been approved ";
                    //     $notificationForStory->url='/employee-portal/story';
                    //     $notificationForStory->save();
                    // }

                    break;

                default:
                    $isLiked = StoryLike::where('story_id', $story->id)->where('created_by', Auth::user()->id)->first();
                    if (!$isLiked) {
                        $storyLike = StoryLike::create(['created_by' => Auth::user()->id, 'story_id' => $story->id]);
                        $storyLike->save();
                        $update = $story->increment($attribute);
                    }
            }

            if ($update) {
                $story = $story->fresh();
                return response()->json(array(
                    'data' => $story->$attribute,
                    'response_code' => 200,
                    'response_message' => 'Successfully updated the Story',
                ));
            } else {
                return response()->json(array(
                    'response_code' => 400,
                    'response_message' => 'Failed to update the Story4',
                ));
            }
        } catch (\Exception $th) {
            //throw $th;
            Log::error($th);
            // dd($th);
        }
    }


    public function update($id)
    {

        if (!$id) {
            Session::flash('error', 'Failed to get story');
            return redirect()->back();
        }

        $story = Story::find($id);
        if (!$story) {
            Session::flash('error', 'Failed to get story');
            return redirect()->back();
        }

        // Session::flash('success', 'Successfully get the story');
        $data = Story::orderBy('created_at', 'desc')->where('status', 'approved')->paginate(8);
        // dd($story);
        return view('employee_portal.story_board', ['update' => $story, 'data' => $data]);
    }

    public function delete($id)
    {
        if (!$id) {
            Session::flash('error', 'Failed to delete the story');
            return redirect()->back();
        }

        $story = Story::find($id);
        if (!$story) {
            Session::flash('error', 'Failed to delete the story');
            return redirect()->back();
        }

        $delete = $story->delete();

        if ($delete) {
            Session::flash('success', 'Successfully deleted the story');
        } else {
            Session::flash('error', 'Failed to delete the story');
        }
        return redirect('/employee-portal/story');
    }

    public function adminDelete($id)
    {
        if (!$id) {
            Session::flash('error', 'Failed to delete the story');
            return redirect()->back();
        }

        $story = Story::find($id);
        if (!$story) {
            Session::flash('error', 'Failed to delete the story');
            return redirect()->back();
        }

        $delete = $story->delete();

        if ($delete) {
            Session::flash('success', 'Successfully deleted the story');
        } else {
            Session::flash('error', 'Failed to delete the story');
        }
        return redirect('/employee-portal/story/admin/list');
    }

    public function adminChangeStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $story = Story::find($request->id);
        if (!$story) {
            return redirect()->back()->withInput();
        }
        $update = $story->update([
            'status' => $request->status
        ]);

        if ($update) {
            $story = Story::find($request->id);
            $createdUser = User::find($story->created_by);
            // dd($createdUser);
            if ($request->status == 'approved') {
                $notificationData = new Notification();
                $notificationData->title = "Story";
                $notificationData->type = "story";
                $notificationData->created_by = Auth::id();
                $notificationData->seen_by = $story->created_by . ",";
                $notificationData->description = ((!$story->dont_publish_name_status) ? ("You have a new story from " . ($createdUser->first_name . " " . $createdUser->last_name)) : ("New story from " . $story->category . " was published"));
                $notificationData->url = '/employee-portal/story';
                $notificationData->save();

                /** for accepted alert to posted user */
                $notificationForStory = new Notification();
                $notificationForStory->title = "Story approved";
                $notificationForStory->type = "story";
                $notificationForStory->created_by = Auth::id();
                $notificationForStory->send_to = $story->created_by . ",";
                $notificationForStory->description = "Congrats " . ($createdUser->first_name . " " . $createdUser->last_name) . ", your story has been approved and posted!";
                // $notificationForStory->description="Hi ".($createdUser->first_name." ".$createdUser->last_name).". Your story (".$story->title.") has been approved ";
                $notificationForStory->url = '/employee-portal/story';
                $notificationForStory->save();
            } elseif ($request->status == 'rejected') {
                /** for accepted alert to posted user */
                $notificationForStory = new Notification();
                $notificationForStory->title = "Story rejected";
                $notificationForStory->type = "story";
                $notificationForStory->created_by = Auth::id();
                $notificationForStory->send_to = $story->created_by . ",";
                $notificationForStory->description = "Hi " . ($createdUser->first_name . " " . $createdUser->last_name) . ". Your story (" . $story->title . ") has been rejected. ";
                $notificationForStory->url = '/employee-portal/story';
                $notificationForStory->save();
            }
            Session::flash('success', 'Successfully updated the status of product');
            //            return view('employee_portal.admin_story_review');

        } else {
            Session::flash('error', 'Failed to update the product status');
            //            return redirect()->back()->withInput();
        }
        // return view('employee_portal.admin_story_review');
        return redirect()->route('employee-portal.story.view.admin');
    }

    public function createOrUpdateStoryCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'sometimes',
            'category' => 'required_without:id',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Failed to create story');
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        if ($request->id) {
            $storyCategory = StoryCategory::find($request->id);
            if (!$storyCategory) {
                Session::flash('error', 'Failed to update Story Category');
                return redirect()->back()->withInput();
            }
            $update = $storyCategory->update([
                'category' => $request->category
            ]);

            if ($update) {
                Session::flash('success', 'Successfully updated the Story Category');
                return redirect()->route('employee-portal.admin.story.view');
            } else {
                Session::flash('error', 'Failed to update the story');
                return redirect()->back()->withInput();
            }
        } else {
            $storyCategory = StoryCategory::create([
                'category' => $request->category
            ]);

            if ($storyCategory) {
                Session::flash('success', 'Story Category has been added successfully');
                return redirect()->back();
            } else {
                Session::flash('error', 'Failed to create Story Category');
                return redirect()->back()->withInput();
            }
        }
    }

    public function deleteStoryCategory($id)
    {
        if (!$id) {
            Session::flash('error', 'Failed to delete the Story Category');
            return redirect()->back();
        }

        $storyCategory = StoryCategory::find($id);
        if (!$storyCategory) {
            Session::flash('error', 'Failed to delete the Story Category');
            return redirect()->back();
        }

        $delete = $storyCategory->delete();

        if ($delete) {
            Session::flash('success', 'Successfully deleted the Story Category');
        } else {
            Session::flash('error', 'Failed to delete the Story Category');
        }
        return redirect()->route('employee-portal.admin.story.view');
    }
}
