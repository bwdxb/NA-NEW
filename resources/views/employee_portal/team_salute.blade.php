@extends('layouts.employee_portal.master')

@push('plugin-styles')
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 d-flex align-items-center justify-content-between saluteHeader">
        <h1 class="h1_heading">Team Member Salute<i class="heading_icon"><img src="{{ url('public/employee_portal/images/team-salute-icon.png') }}"></i></h1>
        <div class="addProduct">
            <a id="addmediacontent" href="#"><i class="mdi mdi-plus-circle"></i> Salute</a>
        </div>
    </div>
</div>
<div class="row grid-margin mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h6>Please fill out a Team Member Salute Card and post it on the E-Noticeboard when you feel a
                    fellow staff member deserves recognition in how they live National Ambulance’s values
                    of <em>Respect, Search for Excellence, Integrity and Mutual Support.</em></h6>
            </div>
        </div>
    </div>
</div>

<!-- @if(session('success'))
            <p class="text-success">
                {{ session('success') }}<br/>
            </p>
            @endif
            @if(session('error'))
            <p class="text-danger">
                {{ session('error') }}
            </p>
            @endif -->
<div class="row grid-margin mt-2 salutList">
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body grey">
                <h4 class="salutHeading">Respect Involves:</h4>
                <ul class="salutListing">
                    <li>Treating people equally, with fairness and respect as we would want to be treated</li>
                    <li>Recognising every opinion and contribution as valuable </li>
                    <li>Showing respect and understanding of different cultures</li>
                    <li>Being Professional in all dealings with others</li>
                    <li>Celebrating each other’s successes and achievements</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body navyBlue">
                <h4 class="salutHeading">Excellence Involves:</h4>
                <ul class="salutListing">
                    <li>Providing first class and consistent service</li>
                    <li>Encouraging feedback from your peers and customers and learning from that feedback</li>
                    <li>Being the best we can be</li>
                    <li>Always giving 100%</li>
                    <li>Continually striving for improvement</li>
                </ul>
            </div>
        </div>
    </div>
    <!--<div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body blue">
                            <h4 class="salutHeading">Accountability Involves:</h4>
                            <ul class="salutListing">
                                <li>Lorem Ipsum dolor sit amet.</li>
                                <li>Consectetur adipiscing elit.</li>
                                <li>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                                <li>Ut enim ad minim veniam.</li>
                                <li>Excepteur sint occaecat cupidatat.</li>
                            </ul>
                        </div>
                    </div>
                </div>-->
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body red">
                <h4 class="salutHeading">Integrity Involves:</h4>
                <ul class="salutListing">
                    <li>Living our values and being honourable in everything we do</li>
                    <li>Being open, honest and ethical in everything we do</li>
                    <li>Always doing the right thing even when not being watched</li>
                    <li>What we say is what we do and we do what we say</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body blue">
                <h4 class="salutHeading">Mutual Suppport Involves:</h4>
                <ul class="salutListing">
                    <li>Responding and operating as a team in all that we do</li>
                    <li>Providing assistance and support to others and seeking help when needed</li>
                    <li>Motivating and communicating well with each other</li>
                    <li>Transferring knowledge and skills</li>
                    <li>Unifying efforts to optimize the performance of the organisation</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4" style="{{isset($update)?'display:none;':''}}">
    <div class="col-md-12">
        <div class="documentFilter">
            <form class="addProductForm" action="" method="get">
                <div class="selectFilter">
                    <label class="filterTxt mr-2">Filter by:</label>
                    <div class="filterBox">
                        <select name="filter" class="form-control">
                            <optgroup label="My Salute">
                                <option>
                                    Recieved Salute
                                </option>
                                <option {{ ( Request::get('filter') =='Sent Salute')?"selected":"" }}>
                                    Sent Salute
                                </option>
                            </optgroup>
                            <optgroup label="Salute Categories">
                                <!-- <option  {{ ( Request::get('filter') ==='All')?"selected":"" }}> -->
                                <option value="All" {{ ( Request::get('filter') ? (Request::get('filter') =='All' ? "selected":"") : "selected")}}>
                                    All
                                </option>
                                <option value="Respect" {{ ( Request::get('filter') ==='Respect')?"selected":"" }}>
                                    Respect
                                </option>
                                <option value="Excellence" {{ ( Request::get('filter') ==='Excellence')?"selected":"" }}>
                                    Excellence
                                </option>
                                <option value="Integrity" {{ ( Request::get('filter') ==='Integrity')?"selected":"" }}>
                                    Integrity
                                </option>
                                <option value="Mutual Support" {{ ( Request::get('filter') ==='Mutual Support')?"selected":"" }}>
                                    Mutual
                                    Support
                                </option>

                            </optgroup>
                        </select>
                    </div>
                    <div class="DT_Reset">
                        <button class="btn btn-primary navyblueBtn" type="submit">Filter</button>
                    </div>
                    <div class="filterBox">
                        <select name="sort" class="form-control">

                            <option value="latest" selected="true">Newest</option>
                            <option value="oldest" {{ ( Request::get('sort') =='oldest')?"selected":"" }}>
                                Oldest
                            </option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="hometeamSalute grid-margin">
    @if(isset($team_salutes))
    <div class="row grid-margin mt-2">
        @foreach($team_salutes as $d)
        <?php
        $color = "";
        switch ($d->category) {
            case "Respect":
                $color = "darkgreySalut";
                break;
            case "Excellence":
                $color = "navyblueSalut";
                break;
            case "Integrity":
                $color = "redSalut";
                break;
            case "Mutual Support":
                $color = "blueSalut";
                break;

            default:
                break;
        }
        ?>
        <div class="col-lg-4 col-md-6 mt-6 actionHover">
            <div class="card salut_certificate">
                <div class="pin"></div>
                <div class="card-body  {{ $color }}">
                    <h3>Team Member Salute</h3>
                    <div class="salutDesciription">
                        <div class="stRow">
                            <label>To:</label>
                            @if($d->getToUserInfo()&&$d->getToUserInfo()->gst_no==1)
                            <del> <span>{{ $d->ts_to }}</span> </del>
                            @else
                            <span>{{ $d->ts_to }}</span>
                            @endif
                        </div>
                        <div class="stRow">
                            <label>From:</label>
                            @if($d->getUserInfo()->gst_no==1)
                            <del><span>{{ $d->ts_from }}</span></del>
                            @else
                            <span>{{ $d->ts_from }}</span>

                            @endif
                        </div>
                        <div class="stRow">
                            <label>Date:</label>
                            <span>{{ \Carbon\Carbon::parse($d->ts_date)->format('d-m-Y') }}</span>
                        </div>
                        <div class="stRow st_des">
                            <!-- <label></label> -->
                            <span>{{ $d->ts_for }}</span>
                        </div>
                    </div>
                    <div class="CategoryTitle">
                        <h4>{{ $d->category }}</h4>
                    </div>
                </div>
            </div>
            @if(Auth::id()==$d->created_by)
            @php
            $tempDelUrl=route('employee-portal.team-salute.delete',$d->id);
            @endphp
            <div class="actionBtn">
                <a class="actionLink" href="{{route('employee-portal.team-salute.update',$d->id)}}">
                    <span class="mdi mdi-pencil-box-outline"></span>
                </a>
                <a class="actionLink redBg" onclick="confirmDelete('{{$tempDelUrl}}','')" url="{{route('employee-portal.team-salute.delete',$d->id)}}">
                    <span class="mdi mdi-delete"></span>
                </a>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @endif
</div>

<!----- Add Form----->
<!-- <div id="mediaContentForm" style="{{isset($update)?'':'display:none;'}}"> -->
    <div id="mediaContentForm">
    <ul class="errorMessages"></ul>
    <div class="row mt-5">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form id="form2" class="addProductForm" action="{{ route('employee-portal.team-salute.create') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ old('id') ? old('id'): ( isset($update->id) ? $update->id : '') }}" class="form-control">

                        <input type="hidden" name="op_type" value="{{ isset($update->id) ? 'update' : 'create' }}" class="form-control">


                        <div class="form_column">
                            <!-- <h5>{{ isset($update)?"Update":"Add" }} Salute
                                Information</h5> -->
                            <h5>Fill Salute Form</h5>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Category</label>
                                    <select class="form-control" name="category" required>
                                        <option selected disabled="true">Which company value does the person you have chosen to receive the Salute Card best demonstrate?
                                        </option>
                                        <option value="Respect" {{old('category') ? old('category') : ((isset($update->category) ? $update->category:'') ==='Respect'?"selected":"")}}>
                                            Respect
                                        </option>
                                        <option value="Excellence" {{ old('category') ? old('category') : ((isset($update->category)?$update->category:'') ==='Excellence'?"selected":"") }}>
                                            Search for Excellence
                                        </option>
                                        <option value="Integrity" {{ old('category') ? old('category') : ((isset($update->category)?$update->category:'') ==='Integrity'?"selected":"") }}>
                                            Integrity
                                        </option>
                                        <option value="Mutual Support" {{ old('category') ? old('category') : ((isset($update->category)?$update->category:'') ==='Mutual Support'?"selected":"") }}>
                                            Mutual Support
                                        </option>


                                    </select>
                                    @error('category')
                                     <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>To</label>
                                    <!-- <input type="text" class="form-control basicAutoComplete" name="ts_to"
                                               autocomplete="on"
                                               value="{{ (old('ts_to')) ? old('ts_to'): (isset($update->ts_to)?$update->ts_to:'') }}"
                                               required> -->
                                    <select class="form-control" name="ts_to" required>
                                        <option selected disabled="true">Select the employee</option>
                                        @foreach($users as $user)
                                        @if($user->status && $user->gst_no!=1)
                                        @if(Auth::user()->id != $user->id )
                                        <option {{ old('ts_to') ? old('ts_to') : ((isset($update->ts_to)?$update->ts_to:'') ===trim($user->first_name . ' ' . $user->last_name)?"selected":"") }}>
                                            {{trim($user->first_name . ' ' . $user->last_name)}}
                                        </option>
                                        @endif
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('ts_to')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>From</label>
                                    <input type="text" class="form-control" name="ts_from" {{--                                               value="{{ (old('ts_from')) ? old('ts_from'): (isset($update->ts_from)?$update->ts_from:session('LoggedUser.first_name').' '. session('LoggedUser.last_name')) }}"--}} value="{{ session('LoggedUser.first_name').' '. session('LoggedUser.last_name') }}" required readonly>
                                    @error('ts_from')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Date</label>
                                    <input id="add_date" type="text" class="form-control" name="ts_date" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly value="{{ ((old('ts_date')) ? old('ts_date'): (isset($update->ts_date)?$update->ts_date:(\Carbon\Carbon::now()->format('Y-m-d')))) }}" required>
                                    <i class="mdi mdi-calendar"></i>
                                    @error('ts_date')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Message</label>
                                    <textarea type="text" class="form-control char-limit" name="ts_for" maxlength="367">{{ (old('ts_for')) ? old('ts_for'): (isset($update->ts_for)?$update->ts_for:'') }}</textarea>
                                    <!-- <input type="text" class="form-control" name="ts_for"
                                        value="{{ (old('ts_for')) ? old('ts_for'): (isset($update->ts_for)?$update->ts_for:'') }}"
                                        required> -->
                                    <div id="the-count">
                                        <span id="current">0</span>
                                        <span id="maximum">/ 367</span>
                                    </div>
                                    <info class="char-size"></info>
                                    @error('ts_for')
                                     <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    @error('document_name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                           </div>
                        
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="form-check form-check-flat">

                                       
                                    <label class="form-check-label">
                                        <input name="agreement" type="checkbox" class="form-check-input"/>
                                        I agree to the 
                                        <i class="input-helper"></i>
                                     <a href="/employee-portal/terms-and-conditions" target="_blank">Terms and Conditions.</a>
                                    </label>  
                                </div>
                                 @error('agreement')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                            </div>

                        </div>
                        <div class="form_column">
                            <div class="row">
                                <div class="btn_column form-group col-md-12 mt-3">
                                    <button type="submit" class="default_btn">Submit</button>
                                    <button type="button" id="closemediacontent" class="default_btn">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if(isset($data))
<div class="row grid-margin mt-2">
    @foreach($data as $d)
    <?php
    $color = "";
    switch ($d->category) {
        case "Respect":
            $color = "darkgreySalut";
            break;
        case "Excellence":
            $color = "navyblueSalut";
            break;
        case "Integrity":
            $color = "redSalut";
            break;
        case "Mutual Support":
            $color = "blackSalut";
            break;
        case "Accountability":
            $color = "blueSalut";
            break;
        default:
            break;
    }
    ?>
    <div class="col-md-4 mb-5">
        <div class="card salut_certificate">
            <!-- <div class="card-body redSalut"> -->
            <div class="card-body {{ $color }}">
                <h3>Team Member Salute</h3>
                <div class="salutDesciription">
                    <div class="stRow">
                        <label>To:</label>
                        <span>{{ $d->ts_to }}</span>
                    </div>
                    <div class="stRow">
                        <label>From:</label>
                        @if($d->getUserInfo()->gst_no==1)
                        <del><span>{{ $d->ts_from }}</span></del>
                        @else
                        <span>{{ $d->ts_from }}</span>

                        @endif
                    </div>
                    <div class="stRow">
                        <label>Date:</label>
                        <span>{{ \Carbon\Carbon::parse($d->ts_date)->format('d-m-Y') }}</span>
                    </div>
                    <div class="stRow st_des">
                        <label>Message:</label>
                        <span>{{ $d->ts_for }}</span>
                    </div>
                </div>
                <div class="CategoryTitle">
                    <h4>{{ $d->category }}</h4>
                </div>
            </div>

            @if(session('LoggedUser.first_name').' '. session('LoggedUser.last_name') == $d->ts_from)
            <div class="saluteAction">
                <a href="{{ route('employee-portal.team-salute.delete',['id'=>$d->id]) }}" type="button" class="actionLink redBg">
                    <span class="mdi mdi-delete"></span>
                </a>
                <a href="{{ route('employee-portal.team-salute.update',['id'=>$d->id]) }}" type="button" class="actionLink">
                    <span class="mdi mdi-pencil-box-outline"></span>
                </a>
            </div>
            @endif
        </div>
    </div>
    @endforeach

</div>
@endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js" defer></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

{{-- <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>--}}
<script src="{{asset('public\vendor\swaggervel\swagger-ui-bundle.js')}}"></script>
<script src="{{asset('public\vendor\swaggervel\swagger-ui.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    function confirmDelete(url, title) {
        return swal({
                title: "Are you sure?",
                text: "Are you sure you want to delete?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = url;
                } else {
                    return false;
                }
            });

    }
    $(document).ready(function() {
        $('textarea').keyup(function() {

            var characterCount = $(this).val().length,
                current = $('#current'),
                maximum = $('#maximum'),
                theCount = $('#the-count');

            current.text(characterCount);


            /*This isn't entirely necessary, just playin around*/
            if (characterCount < 70) {
                current.css('color', '#666');
            }
            if (characterCount > 70 && characterCount < 90) {
                current.css('color', '#6d5555');
            }
            if (characterCount > 90 && characterCount < 100) {
                current.css('color', '#793535');
            }
            if (characterCount > 100 && characterCount < 120) {
                current.css('color', '#841c1c');
            }
            if (characterCount > 120 && characterCount < 139) {
                current.css('color', '#8f0001');
            }

            if (characterCount >= 140) {
                maximum.css('color', '#8f0001');
                current.css('color', '#8f0001');
                theCount.css('font-weight', 'bold');
            } else {
                maximum.css('color', '#666');
                theCount.css('font-weight', 'normal');
            }


        });
        $('#closemediacontent').click(function() {
            //$('#storyForm').toggle('slow');
            $('#form2')[0].reset();
            $("#mediaContentForm").toggle('slow');
            $('html, body').animate({
                scrollTop: 0
            }, 1000);
        });

        $("#myInput").on("keyup", function() {
            var input, filter, table, tr, td, i, txtValue;
            // input = document.getElementById("myInput");
            input = document.getElementById("stRow");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByClassName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByClassName("search")[0];
                td1 = tr[i].getElementsByClassName("search")[1];
                if (td && td1) {
                    txtValue = td.textContent || td.innerText;
                    txtValue1 = td1.textContent || td1.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(
                            filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        });

    });


    var createAllErrors = function() {
        var form = $(this),
            errorList = $("ul.errorMessages", form);

        var showAllErrorMessages = function() {
            errorList.empty();

            // Find all invalid fields within the form.
            var invalidFields = form.find(":invalid").each(function(index, node) {

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
        form.on("submit", function(event) {
            if (this.checkValidity && !this.checkValidity()) {
                $(this).find(":invalid").first().focus();
                event.preventDefault();
            }
        });

        $("input[type=submit], button:not([type=button])", form)
            .on("click", showAllErrorMessages);

        $("input", form).on("keypress", function(event) {
            var type = $(this).attr("type");
            if (/date|email|month|number|search|tel|text|time|url|week/.test(type) &&
                event.keyCode == 13) {
                showAllErrorMessages();
            }
        });
    };

    $("form").each(createAllErrors);

    $(function() {
        // $( "#add_date" ).datepicker({
        //     dateFormat: "dd-mm-yy"
        //     ,	duration: "fast"
        // });
        maxLength($('.char-limit'));
    });

    function maxLength(el) {
        if (!('maxLength' in el)) {
            var max = el?.attributes?.maxLength?.value;
            el.onkeypress = function() {
                if (this.value.length >= max) return false;
            };
        }
    }
</script>
@endsection

@push('plugin-scripts')
    @error('ts_for')
    <script type="text/javascript">
        $(document).ready(function() {
            $('html, body').animate({
              scrollTop: $("#mediaContentForm").offset().top - 100
            }, 1000);
        });
    </script>
    @enderror

    @error('agreement')
    <script type="text/javascript">
        $(document).ready(function() {
            $('html, body').animate({
              scrollTop: $("#mediaContentForm").offset().top - 100
            }, 1000);
        });
    </script>
    @enderror
@endpush

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush