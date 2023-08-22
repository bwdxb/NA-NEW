@extends('layouts.employee_portal.master')
@php
    use app\Http\helper\Helper as Helper;
    $data_classification= Helper::getDocumentType();
    $department_owner =[
  'QHSE'=>'QHSE',
  'Clinical Service'=>'Clinical Service',
  'Corporate'=>'Corporate',
  'Finance'=>'Finance',
  'IT'=>'IT',
  'Human Resources'=>'Human Resources',
  'Operations'=>'Operations',
  'Supply Chain'=>'Supply Chain',
  ];
$department_owner = Helper::getDocumentDepartment();
@endphp
@push('plugin-styles')
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="h1_heading">Document Library</h1>
    </div>
    <form action="" class="w-100" method="get">

    <div class="col-md-12 formgroup">
    <label class="filterTxt mr-2">Search:</label>
                    <div class="filterBox w-100">
                    <input type="text" name="search_key" class="form-control w-100 docSearch" value="{{Request::get('search_key')}}" placeholder="Search documents by their controlled number, file name or keywords" />

                    </div>
    </div>
    </form>
    <div class="col-lg-12 grid-margin">
        <div class="documentFilter">
            <form class="addProductForm"
                action="" method="get">
                <!-- <input type="hidden" value="employee" name="logged"> -->
                <div class="selectFilter">
      
                    <label class="filterTxt mr-2">Filter by:</label>
                    <!-- <div class="filterBox">
                    <input type="text" name="search_key" class="form-control" value="{{Request::get('search_key')}}" placeholder="Search documents by their controlled number, file name or keywords" />

                    </div> -->
                    <div class="filterBox">
                        <select name="department_owner" id="department_owner" class="form-control">
                          <option value="">Department</option>
                          @foreach($department_owner as $key=>$docDept)                             
                            <option @if($type ==Request::get('department_owner')) selected="selected" @endif value="{{$docDept->department}}">{{$docDept->department}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filterBox">
                        <select name="document_type_id" id="document_type_id" class="form-control">
                            <option value="">Document Type</option>
                            @foreach($document_type as $key=>$type) 
                                <option @if($key ==Request::get('document_type_id')) selected="selected" @endif value="{{$key}}">{{$type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <div class="filterBox">
                        <input type="date" name="filter_date" class="form-control"
                            value="{{  isset($filter )?$filter['filter_date'] :'' }}" />
                        @error('filter_date')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div> -->
                   
                    <!-- <div class="filterBox">
                        <select name="sort" class="form-control">
                            <optgroup label="Sort By">
                                <option value="latest" selected="true"  >Newest to Oldest</option>
                                <option value="ASC" @if(Request::get('sort') =='ASC') selected @endif>
                                    Oldest to Newest</option>
                            </optgroup>
                        </select>                     
                    </div> -->
                     <div class="DT_Reset">
                        <button class="btn submit" type="submit"><i class="mdi mdi-submit-variant"></i> Filter</button>
                        <a class="btn submit" type="reset" href="{{url('/employee-portal/document-library')}}"><i class="mdi mdi-redo-variant" onclick="(function(){$('form').clear()})"></i> Reset</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="card-title">Records in Document Library</h4> -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Controlled Number</th>
                                <th>Document Name</th>
                                <th>Version</th>
                                <th>Date</th>
                                <th>Department</th>
                                <th>Document Type</th>
                                <!-- <th>Data Classification</th> -->
                                <!-- <th>Document Format</th> -->
                                <th>Size</th>
                                <!-- <th>Date</th> -->
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @forelse($data as $d)
                                <tr>

                                    <td class="search">{{ $d->controlled_number }}</td>
                                    <td class="py-1 doc_name search">{{ $d->document_name }}</td>
                                    <td class="v_number">{{ $d->version_number }}</td>
                                    <td class="">{{(new \Carbon\Carbon($d->document_date))->format('M Y') }}</td>
                                    <td>{{ $d->department_owner }}</td>
                                    <td>{{ $d->document_type }}</td>
                            
                                    <td class="file_size">{{ $d->file_size }}</td>
                                    <!-- <td class="created_dt">{{ $d->created_at }}</td> -->
                                    <td class="file_link"><a
                                            href="{{ $d->document_file }}"
                                            class="doc_button" download="{{ $d->document_name}}"><i aria-hidden="true"
                                                class="mdi mdi-cloud-download-outline mr-2"></i>Download</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="9" style="text-align: center;"><b>No Records in the
                                            Document Library!!!</b></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                  

                </div>
            </div>
        </div>
    </div>
</div>
<div class="text-center">{{$data->appends(request()->input())->links()}}</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                td1 = tr[i].getElementsByTagName("td")[1];
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
</script>
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush