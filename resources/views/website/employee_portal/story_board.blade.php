@extends('layouts.employee_portal.master')

@push('plugin-styles')
@endpush

@section('content')
<div class="row mt-4">
    <div class="col-md-12 d-flex align-items-center justify-content-between">
        <h1 class="h1_heading">Stories</h1>
        <div id="addstory" class="addProduct">
            <a href="#"><i class="mdi mdi-plus-circle"></i>Add Your Story</a>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-12">
        <div class="documentFilter">
            <div class="selectFilter">
                <label class="filterTxt mr-2">Filter by:</label>
                <div class="filterBox">
                    <select name="Category" class="form-control">
                        <option value="eBooks">My Stories</option>
                        <optgroup label="Status">
                            <option value="eBooks">All</option>
                            <option value="eBooks">Approved</option>
                            <option value="eBooks">Pending Departments</option>
                        </optgroup>

                        <optgroup label="Category">
                            <option value="eBooks">All Categories</option>
                            <option value="eBooks">Operations</option>
                            <option value="eBooks">Supporting Departments</option>
                            <option value="eBooks">AUH Contracts</option>
                        </optgroup>
                        
                        <optgroup label="Media Type">
                            <option value="eBooks">All</option>
                            <option value="eBooks">Photo</option>
                            <option value="eBooks">Video</option>
                        </optgroup>
                    </select>
                </div>
                <div class="filterBox">
                    <!-- <input type="text" placeholder="Date" class="form-control"> -->
                    <select name="Newest/Oldest" class="form-control">
                        <option value="Sale">All</option>
                        <option value="Sale">Monthly</option>
                        <option value="Sale">Yearly</option>
                    </select>
                </div>
                <div class="DT_Reset">
                    <a href="#" class="reset"><i class="mdi mdi-undo-variant"></i> Reset</a>
                </div>
            </div>
            <!-- <div class="recentFilter">
                <div class="filterBox">
                    <select name="Newest/Oldest" class="form-control">
                        <option value="">Newer/Older</option>
                        <option value="eBooks">Newest to Oldest</option>
                        <option value="Sale">Oldest to Newest</option>
                    </select>

                </div>
            </div> -->
        </div>
    </div>
</div>

<div class="row grid-margin mt-4 storyWrapper">
    <!-- <div class="d-flex justify-content-center w-100"> -->
        @forelse ($data as $d)
        <div class="col-xl-4 col-lg-4">
            <div class="storyItem mb-4">
                <a class="hoverEffect" href="#" target="_blank">
                    <div class="storyImage">
                        @if($d->media_type == 'image')
                        <img class="imgHover" src="{{ url($d->file_url) }}">
                        @else
                        <iframe allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen="" frameborder="0"
                        src="{{ url($d->file_url) }}"
                        controlsList="nodownload"
                        title="video player"></iframe>
                        @endif
                        <div class="actionBtn">
                            <a href="{{route('employee-portal.story.delete',['id'=>$d->id])}}" type="button" class="actionLink redBg"><span class="mdi mdi-delete"></span></a>
                            <a href="{{route('employee-portal.story.update',['id'=>$d->id])}}" type="button" class="actionLink"><span class="mdi mdi-pencil-box-outline"></span></a>
                        </div>
                    </div>
                    
                    <div class="storyDescription">

                        <div class="storyCredit">
                            <span>{{$d->category}}</span>
                        </div>                        
                        <h4 class="storyTitle mt-3">{{$d->title}}</h4>
                        <p><!-- There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form, by injected humour, or randomised words which don't
                            look... -->
                            <!-- <small>read more</small> -->
                            {{$d->story}}
                        </p>
                        <div class="storyAuthor">
                            <span class="authorName">@if(!$d->dont_publish_name_status)<font>By </font>{{$d->file_credits}} .@endif</span>
                            <span class="poostDate">{{ \Carbon\Carbon::parse($d->created_at)->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @empty

        <div class="container-fluid" colspan="4" style="text-align: center;">
            <b>
                No Records in the repository
            </b>
        </div>
        @endforelse
        <!-- </div> -->
    </div>
    <div id="storyForm" class="row mt-5" style="display:none;">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">  
                    <h3>Tell Us Your Story</h3>
                    <p>Do you have a story to tell or a photo to share? Have you witnessed or been part of a successful incident or event? Have you or your coworker done an extra ordinary job in saving a patient’s life or making a difference at work? Please share with us. Your story will be reviewed before it goes live and we will get in touch if we require more details.</p>
                    <form class="addProductForm" action="{{ route('employee-portal.story.create') }}"
                    method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="hidden" 
                    name="id" 
                    value="{{ old('id') ? old('id'): ( isset($update->id) ? $update->id : '') }}" 
                    class="form-control">


                    @if(session('success'))
                    <p class="text-success">
                        {{ session('success') }}<br />
                    </p>
                    @endif
                    @if(session('error'))
                    <p class="text-danger">
                        {{ session('error') }}
                    </p>
                    @endif
                    <ul class="errorMessages text-danger"
                    style="list-style:unset;background-color: bisque;"></ul>
                    <div class="form_column">
                        <h5>Add Your Story</h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Title</label>
                                <input type="text" 
                                name="title" 
                                value="{{ (old('title')) ? old('title'): (isset($update->title)?$update->title:'') }}" 
                                class="form-control">
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Category</label>
                                <select class="form-control" name="category">
                                    <option selected disabled="true">In which Category did the story belong to?</option>
                                    <option {{ old('category') ? old('category') : (isset($update->category)?$update->category:'') ==='Operations'?"selected":"" }}>Operations</option>
                                    <option {{ old('category') ? old('category') : (isset($update->category)?$update->category:'') ==='Supporting Departments'?"selected":"" }}>Supporting Departments</option>
                                    <option {{ old('category') ? old('category') : (isset($update->category)?$update->category:'') ==='AUH Contracts'?"selected":"" }}>AUH Contracts</option>
                                </select>
                            </div>
                        </div>
                    <!--    <div class="row">
                             <div class="form-group col-md-6">
                                <label>Photo/Video Credits</label>
                                <input type="text" 
                                pattern="[A-Za-z ]{1,32}"
                                title="no numeric values accepted for Photo Credits" 
                                name="nationality"
                                value="{{ old('city') }}" 
                                class="form-control">
                                @error('area_location')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> -->
                           <!--  <div class="form-group col-md-6">
                                <label> Credits</label>
                                <input type="text" class="form-control">
                                @error('area_location')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> 
                        </div>-->
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Tell Us Your Story</label>
                                <textarea class="form-control" row="3" name="story" required>{{ (old('story')) ? old('story'): (isset($update->story)?$update->story:'') }}</textarea>
                                @error('story')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="custom-file">
                                    <label for="exampleFormControlFile1">Upload Photo/Video</label>
                                    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1" required>
                                    @error('file')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group col-md-6">
                                <label>Photo/Video Credits</label>
                                <input type="text" 
                                pattern="[A-Za-z ]{1,32}"
                                title="no numeric values accepted for Photo Credits" 
                                name="file_credits"
                                value="{{ (old('file_credits')) ? old('file_credits'): (isset($update->file_credits)?$update->file_credits:'') }}" 
                                class="form-control">
                                @error('file_credits')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input type="checkbox" 
                                        name="dont_publish_name_status" 
                                        class="form-check-input" {{ old('dont_publish_name_status') ? old('dont_publish_name_status') : (isset($update->dont_publish_name_status)?$update->dont_publish_name_status: '') ==='1'?"checked":"" }}> 
                                        Please don’t publish my name <i class="input-helper"></i></label>
                                    </div>
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input"> 
                                            I accept the Media Terms and Conditions <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form_column">
                                <div class="row">
                                    <div class="btn_column form-group col-md-12 mt-3">
                                        <button type="submit" class="default_btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script>
            var createAllErrors = function () {
                var form = $(this),
                errorList = $("ul.errorMessages", form);

                var showAllErrorMessages = function () {
                    errorList.empty();

                // Find all invalid fields within the form.
                var invalidFields = form.find(":invalid").each(function (index, node) {

                    // Find the field's corresponding label
                    var label = node.name,
                        // Opera incorrectly does not fill the validationMessage property.
                        message = node.validationMessage || 'Invalid value.';
                    // $(this).parent('div').append("<span class='text-danger'>" +  message + "</span>");

                    errorList
                    .show()
                    .append("<li><span>" + label + "</span> " + message + "</li>");
                });
            };

            // Support Safari
            form.on("submit", function (event) {
                if (this.checkValidity && !this.checkValidity()) {
                    $(this).find(":invalid").first().focus();
                    event.preventDefault();
                }
            });

            $("input[type=submit], button:not([type=button])", form)
            .on("click", showAllErrorMessages);

            $("input", form).on("keypress", function (event) {
                var type = $(this).attr("type");
                if (/date|email|month|number|search|tel|text|time|url|week/.test(type) &&
                    event.keyCode == 13) {
                    showAllErrorMessages();
            }
        });
        };

        $("form").each(createAllErrors);

        $('#addstory').click(function(){
            $('#storyForm').toggle('slow')
        })
    </script>
    @endsection

    @push('plugin-scripts')
    @endpush

    @push('custom-scripts')
    @endpush