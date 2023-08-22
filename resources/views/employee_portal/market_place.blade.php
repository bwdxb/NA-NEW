@php
        use app\Http\helper\Helper as Helper;
    @endphp
@extends('layouts.employee_portal.master')

@push('plugin-styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12 d-flex align-items-center justify-content-between">
            <h1 class="h1_heading">Market Place</h1>
            <div class="addProduct">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i
                            class="mdi mdi-plus-circle"></i> Product</a>
            </div>
        </div>
    </div>
    <div class="row grid-margin mt-4 marketplace_wrapper">
        <div class="d-flex justify-content-center w-100">
            <!-- <input class="form-control" id="myInput" type="text" placeholder="Search.."> -->
            {{ $data->links() }}
        </div>
        @foreach($data as $market)
       
        
        @php
        $marketPlaceImages = Helper::getMarketImages($market->id);
    @endphp
            <div class="col-xl-3 col-lg-4 col-sm-6">

                <div class="product product--card">
                    <div class="product__thumbnail">
                        <img src="{{ url($market->photo) }}"
                             alt="Product Image">
                        <div class="actionBtn">
                            @if($market->created_by == auth()->id())
                           @php
                                $urlDeleteTemp=route('employee-portal.market-place.delete',['id'=>$market->id, 'title'=>$market->title]);

                           @endphp
                                <a url=""
                                   type="button" class="actionLink redBg" title="Delete Product"
                                   onclick='confirmDelete("{{$urlDeleteTemp}}","{{$market->title}}")' >
                                   <span
                                            class="mdi mdi-delete"></span></a>
                                <a href="{{ route('employee-portal.market-place.fetch',['id'=>$market->id, 'title'=>$market->title]) }}"
                                   type="button" class="actionLink" title="Edit Product Details">
                                    {{--                               data-toggle="modal" data-target="#exampleModal2">--}}
                                    <span class="mdi mdi-pencil-box-outline"></span></a>
                            @else
                                <a url="" type="button" class="actionLink whiteBg" title="Show Interest"
                                    onclick="confirmIntrest(`{{route('employee-portal.market-place.show-interest',$market->id)}}`,`A message will be sent to {{$market->email}} informing him of your interest in the product they are selling`)"
                                    >
                                    <img style="width:22px;" src="{{ url('public/employee_portal/images/interest-icon.png') }}">
                                </a>  
                                <!-- onclick="return confirm('A message will be sent to {{$market->email}} informing him of your interest in the product they are selling')" -->
                            @endif
                        </div>
                        @if(isset($market->category))
                            <div class="product_cat">
                                <a href="#"><span class="mdi mdi-library-books"></span>{{ $market->category }}</a>
                            </div>
                        @endif
                    </div>

                    <div class="product-desc">
                        <h4>    
                            <a href="#" class="product_title">
                                {{ $market->title }}
                            </a>
                        </h4>
                        <div class="productPrice">
                            <span>AED {{ $market->price }}</span>
                        </div>
                        <p>{{ $market->description }}</p>
                        <div class="storyAuthor mt-1">
                             <span class="{{$market->getUserInfo()->gst_no==1?'authorName text-muted':'authorName'}}">

                                  <font>Posted By </font>
                                  @if($market->getUserInfo()->gst_no==1)
                                  <del>{{ $market->getUserFullName() }}</del>
                                  @else
                                  {{ $market->getUserFullName() }}

                                  @endif
                             </span>
                        </div>
                        <ul class="date_place">
                            <li class="date_time">
                                <span class="mdi mdi-calendar"></span>
                                <p>{{ \Carbon\Carbon::parse($market->created_at)->diffForHumans() }}</p>
                            </li>
                            @if(isset($market->created_by ))
                                <li>
                                   {{--   <span class="mdi mdi-map-marker"></span>
                                  <p>{{ $market->created_by }}</p>--}}
                                    <span class="mdi mdi-email"></span>
                                    <p>{{ $market->email }}</p>          
                                </li>
                               
                            @endif
                            @if($market->created_by == auth()->id())
                            <li>
                                   
                                   <a href="#" data-toggle="modal" data-target="#interestedmarketplace{{$market->id}}"><small>Show Interest Received</small></a>         
                                </li>
                                @endif
                                <a href="#" data-toggle="modal" data-target="#moredetail{{$market->id}}"><small>Details</small></a>         
                        </ul>
                    </div>

                </div>

            </div>
            
<!-- Modal -->
<div class="modal fade" id="interestedmarketplace{{$market->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Interested Users for {{$market->title}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table class="table table-bordered">
              <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                </tr>
        @foreach($market->getIntrestedUsers() as $key=> $user)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$user->first_name." ".$user->last_name}}</td>
                <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
            </tr>
            
           
            @endforeach
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="moredetail{{$market->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="moredetailLabel">{{$market->title}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="product__thumbnail">
          @foreach($marketPlaceImages as $img)
                        <img src="{{ url($img->file_url) }}"
                             alt="Product Image" class="w-25">
            @endforeach
       </div>
        
       <div class="product-desc">
                        <h4>    
                            <a href="#" class="product_title">
                                {{ $market->title }}
                            </a>
                        </h4>
                        <div class="productPrice">
                            <span>AED {{ $market->price }}</span>
                        </div>
                        
                        <p>{{ $market->description }}</p>

                        Address :<p>{{ $market->address }}</p>
                        email :<p>{{ $market->email }}</p>
                        phone :<p>{{ $market->phone }}</p>

                        <div class="storyAuthor mt-1">
                             <span class="authorName">
                                  <font>Posted By </font>{{ $market->getUserFullName() }}
                             </span>
                        </div>
                        <ul class="date_place">
                            <li class="date_time">
                                <span class="mdi mdi-calendar"></span>
                                <p>{{ \Carbon\Carbon::parse($market->created_at)->diffForHumans() }}</p>
                            </li>
                            @if(isset($market->created_by ))
                                <li>
                                   {{--   <span class="mdi mdi-map-marker"></span>
                                  <p>{{ $market->created_by }}</p>--}}
                                    <span class="mdi mdi-email"></span>
                                    <p>{{ $market->email }}</p>          
                                </li>
                               
                            @endif
                            @if($market->created_by == auth()->id())
                            <li>
                                   
                                   <a href="#" data-toggle="modal" data-target="#interestedmarketplace{{$market->id}}"><small>Show Interest Received</small></a>         
                                </li>
                                @endif
                        </ul>
                    </div>
            
         
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        @endforeach
        <div class="d-flex justify-content-center w-100">
            {{ $data->links() }}
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog  modal-lg m-5" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">What are you selling?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <p></p>
                                <div class="card-body">
                                    <form id="form1" class="addProductForm"
                                          action="{{ route('employee-portal.market-place.create') }}"
                                          method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @if(session('success'))
                                            <p class="text-success">
                                                {{ session('success') }}<br/>
                                            </p>
                                        @endif
                                        @if(session('error'))
                                            <p class="text-danger">
                                                {{ session('error') }}
                                            </p>
                                        @endif
                                        <ul class="errorMessages text-danger"
                                            style="list-style:unset;background-color: bisque;">
                                        </ul>
                                        <div class="form_column">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Title*</label>
                                                    <input type="text" class="form-control" name="title"
                                                           value="{{ old('title') }}" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Email*</label>
                                                    <input type="email" class="form-control" required name="email"
                                                           value="{{ old('email') }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Phone*</label>
                                                    <input type="text"
                                                           class="form-control" name="phone"
                                                           value="{{ old('phone') }}" required>
                                                </div>
                                                {{--                                                <div class="form-group col-md-6">--}}
                                                {{--                                                    <label>Category</label>--}}
                                                {{--                                                    <input type="text" class="form-control" name="category"--}}
                                                {{--                                                           value="{{ old('category') }}">--}}

                                                {{--                                                </div>--}}
                                                <div class="form-group col-md-6">
                                                    <label>Price*</label>
                                                    <input type="text" class="form-control" name="price"
                                                           value="{{ old('price') }}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                {{--                                                <div class="form-group col-md-6">--}}
                                                {{--                                                    <label>Price*</label>--}}
                                                {{--                                                    <input type="text" class="form-control" name="price"--}}
                                                {{--                                                           value="{{ old('price') }}" required>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="form-group col-md-6">--}}
                                                {{--                                                    <label>Location/Address*</label>--}}
                                                {{--                                                    <input type="text" class="form-control" name="address" required--}}
                                                {{--                                                           value="{{ old('address') }}">--}}
                                                {{--                                                </div>--}}

                                                <div class="form-group col-md-12">
                                                    <label>Location/Address*</label>
                                                    <textarea class="form-control" row="3"
                                                              name="address" required>{{ old('address') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Description</label>
                                                    <textarea class="form-control" row="3"
                                                              name="description">{{ old('description') }}</textarea>
                                                </div>
                                            </div>
                                            <label id="cover-pic">
                                                Select Cover Picture
                                            </label>
                                            <div class="row">

                                                <div class="gallery d-inline-flex"></div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="custom-file">
                                                        <label for="exampleFormControlFile1">Upload Photo *</label>
                                                        <input type="file" class="form-control-file file-size-limit" name="photos[]"
                                                               multiple
                                                               id="gallery-photo-add" required>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                                <div class="form-group col-md-12">
                                                    <div class="form-check form-check-flat">
                                                        <label class="form-check-label">
  <input type="checkbox" class="form-check-input" required>
                                                            I agree to the <i class="input-helper"><a href="/employee-portal/terms-and-conditions" target="_blank">Terms and Conditions</a></i> and acknowledge that National Ambulance (NA) is not responsible or will not be held liable for the products advertised on the marketplace. NA neither facilitates the payment nor delivery of items posted in the marketplace, and also is not able to verify whether a buyer or seller received what was agreed upon between them. NA is also not responsible for any disputes arising for purchases made for products available via the marketplace. *
                                                            
                                                        </label>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        <div class="form_column">
                                            <div class="row">
                                                <div class="btn_column form-group col-md-12 mt-3">
                                                    <button type="submit" class="default_btn" >Submit</button>
                                                    <button  type="button" id="modal-close" class="default_btn " >Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade " id="exampleModal2" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" style="padding-right: 15px;"
         aria-hidden="true">
        <div class="modal-dialog  modal-lg m-5" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update the Product details?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form id="form2" class="addProductForm"
                                          action="{{ route('employee-portal.market-place.update') }}"
                                          method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @if(session('success'))
                                            <p class="text-success">
                                                {{ session('success') }}<br/>
                                            </p>
                                        @endif
                                        @if(session('error'))
                                            <p class="text-danger">
                                                {{ session('error') }}
                                            </p>
                                        @endif
                                        <ul class="errorMessages text-danger"
                                            style="list-style:unset;background-color: bisque;"></ul>

                                        <input type="hidden" id="product_id"
                                               value="{{ ( isset($details->id) ? $details->id : '') }}" name="id">
                                        <div class="form_column">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Title*</label>
                                                    <input type="text" class="form-control" id="product_title"
                                                           value="{{ ( isset($details->title) ? $details->title : '') }}"
                                                           name="title" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Email*</label>
                                                    <input type="email" class="form-control" id="product_email" required
                                                           value="{{ ( isset($details->email) ? $details->email : '') }}"
                                                           name="email">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Phone*</label>
                                                    <input type="text" id="product_phone"
                                                           value="{{ ( isset($details->phone) ? $details->phone : '') }}"
                                                           class="form-control" name="phone" required>
                                                </div>
                                                {{--                                                <div class="form-group col-md-6">--}}
                                                {{--                                                    <label>Category</label>--}}
                                                {{--                                                    <input type="text" class="form-control" name="category"--}}
                                                {{--                                                           value="{{ old('category') }}">--}}

                                                {{--                                                </div>--}}
                                                <div class="form-group col-md-6">
                                                    <label>Price*</label>
                                                    <input type="text" class="form-control" name="price"
                                                           id="product_price"
                                                           value="{{ ( isset($details->price) ? $details->price : '') }}"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                {{--                                                <div class="form-group col-md-6">--}}
                                                {{--                                                    <label>Price*</label>--}}
                                                {{--                                                    <input type="number" class="form-control" name="price"--}}
                                                {{--                                                           value="{{ old('price') }}" required>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="form-group col-md-6">--}}
                                                {{--                                                    <label>Location/Address*</label>--}}
                                                {{--                                                    <input type="text" class="form-control" name="address" required--}}
                                                {{--                                                           value="{{ old('address') }}">--}}
                                                {{--                                                </div>--}}

                                                <div class="form-group col-md-12">
                                                    <label>Location/Address*</label>
                                                    <textarea class="form-control" row="3" id="product_address"
                                                              name="address"
                                                              required>{{ ( isset($details->address) ? $details->address : '') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Description</label>
                                                    <textarea class="form-control" row="3" id="product_description"
                                                              name="description">{{ ( isset($details->description) ? $details->description : '') }}</textarea>
                                                </div>
                                            </div>
                                            <label id="cover-pic">
                                                Select Cover Picture
                                            </label>
                                            <div class="row">

                                                <div class="d-inline-flex">
                                                    @if(isset($details))
                                                        @forelse($details->photos as $img)
                                                            <div class='form-check' id="{{$img->id}}">
                                                                <input class='form-check-input' type='radio'
                                                                       name='cover_img' value='{{$img->id}}'
                                                                       id='flexRadioDefaultUpdate-{{$img->id}}'/>
                                                                <label class='form-check-label'
                                                                       for='flexRadioDefaultUpdate-{{$img->id}}'>
                                                                    <img class='img-thumbnail'
                                                                         src='{{url($img->file_url)}}'
                                                                         style='width: 200px;'/>
                                                                </label>
                                            <a url=""
                                   type="button" class="actionLink redBg" title="Delete Product"
                                   onclick='hideimage("{{$img->id}}")' >
                                   <span
                                            class="mdi mdi-delete"></span></a>
                                                                {{array_reverse(explode('/',$img->file_url))[0]}}
                                                            </div>
                                                            <input type="checkbox" style="display:none;" id="chk{{$img->id}}"  title="Delete Image" class="form-check-input" name="deleteimage[]" value="{{$img->id}}">
                                                        @empty

                                                            <div class="container-fluid" colspan="4"
                                                                 style="text-align: center;">
                                                                <b>
                                                                    No Pics for the Product {{$img->title}}
                                                                </b>
                                                            </div>
                                                        @endforelse
                                                    @endif

                                                </div>
                                                <div class="gallery d-inline-flex"></div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="custom-file">
                                                        <label for="exampleFormControlFile1">Upload More Photo</label>
                                                        <input type="file" class="form-control-file  file-size-limit" name="photos[]"
                                                               multiple
                                                               id="gallery-photo-update"/>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form_column">
                                            <div class="row">
                                                <div class="btn_column form-group col-md-12 mt-3">
                                                    <button type="submit" class="default_btn">Submit</button>
                                                    <button type="button" id="modal-close-2" class="default_btn">cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
     $().ready(()=>{
        $("#modal-close").on("click",()=>{
$("#exampleModal").modal('hide');
$('#form1')[0].reset();

     });
     $("#modal-close-2").on("click",()=>{
$("#exampleModal2").modal('hide');
$('#form2')[0].reset();


     });
     })
             function confirmDelete(url,title){
                          return  swal({
                        title: "Are you sure?",
                        text: "Are you sure you want to delete "+title+"!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        })
                        .then((willDelete) => {
                        if (willDelete) {
                            window.location.href=url;
                        } else {
                            return false;
                        }
                        });
                        
            }
             function confirmIntrest(url,msg){
                          return  swal({
                        text: msg,
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        })
                        .then((willDelete) => {
                        if (willDelete) {
                            window.location.href=url;
                        } else {
                            return false;
                        }
                        });
                        
            }
            function hideimage(id){
                $("#"+id).hide();
                $("#chk"+id).prop("checked", true);
                $("#chk"+id).val(id);
            }
        $(function () {
            @if(isset($details))
            $('#exampleModal2').modal('show')
            @endif
            $('#cover-pic').hide();
            // Multiple images preview in browser
            var imagesPreview = function (input, placeToInsertImagePreview) {
                $('#cover-pic').hide();
                $("div.gallery").html("");
                if (input.files) {
                    var filesAmount = input.files.length;
                    $('#cover-pic').show();
                    for (i = 0; i < filesAmount; i++) {
                        let file_name = input.files[i].name;
                        var reader = new FileReader();
                        let index = i;
                        reader.onload = function (event) {

                            $($.parseHTML(
                                "<div class='form-check'><input class='form-check-input' type='radio' name='cover_img' value='" +
                                file_name + "' id='flexRadioDefault" +
                                index +
                                "'/><label class='form-check-label' for='flexRadioDefault" +
                                index +
                                "'><img  class='img-thumbnail' src='" +
                                event.target.result +
                                "' style='width: 200px;'/>" + file_name + "</label><a type='button' class='actionLink redBg fileRemove' title='Delete Product' onclick='' ></div>"
                            ))
                                .appendTo(
                                    placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };

            $('#gallery-photo-add').on('change', function () {
                imagesPreview(this, 'div.gallery');
                remove();
            });

            $('#gallery-photo-update').on('change', function () {
                imagesPreview(this, 'div.gallery');
                remove();
            });
        });
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
function remove(){
    
    $('div.gallery').on('click','.fileRemove',function(){
alert($(this).parents('.form-check').find('img').attr('src'));
            var files= $('#gallery-photo-add').get(0).files;

            for(i=0;i<files.length;i++){
                if(files[i]==$(this).parents('.form-check-label').find('img').attr('src')){
                    files= jQuery.grep(files, function(value) {
                    return value != files[i];
                    });
                }
            }
            $(this).parents('.form-check').find('img').remove();
        });
}
    </script>
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush