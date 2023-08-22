@extends('layouts.employee_portal.master')

@push('plugin-styles')
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="h1_heading">Admin market place for verification</h1>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label>Search:</label>

            <input type="text" id="myInput" class="form-control"
                placeholder="Search for a keyword" />

        </div>
    </div>

    <div class="col-lg-12 grid-margin">
        <!-- <div class="documentFilter">
            <form class="addProductForm"
                action="{{ route('employee-portal.document-library.adminfilter') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" value="admin" name="logged">
                <div class="selectFilter">
                    <label class="filterTxt mr-2">Filter by:</label>
                    <div class="filterBox">
                        <select name="department" class="form-control">
                            <optgroup label="Department Category">
                                <option value="all" selected="true">All</option>
                                <option value="Operation"
                                    {{ ( isset($filter )&& $filter['department'] ==='Operation')?"selected":"" }}>
                                    Operation</option>
                                <option value="Corporate"
                                    {{ ( isset($filter )&& $filter['department'] ==='Corporate')?"selected":"" }}>
                                    Corporate</option>
                                <option value="Human Resources (HR)"
                                    {{ ( isset($filter )&& $filter['department'] ==='Human Resources (HR)')?"selected":"" }}>
                                    Human Resources (HR)</option>
                                <option value="Finance"
                                    {{ ( isset($filter )&& $filter['department'] ==='Finance')?"selected":"" }}>
                                    Finance</option>
                                <option value="Supply Chain"
                                    {{ ( isset($filter )&& $filter['department'] ==='Supply Chain')?"selected":"" }}>
                                    Supply Chain</option>
                                <option value="IT"
                                    {{ ( isset($filter )&& $filter['department'] ==='IT')?"selected":"" }}>
                                    IT</option>
                                <option value="QHSE & BC"
                                    {{ ( isset($filter )&& $filter['department'] ==='QHSE & BC')?"selected":"" }}>
                                    QHSE & BC</option>
                                <option value="Clinical Governance"
                                    {{ ( isset($filter )&& $filter['department'] ==='Clinical Governance')?"selected":"" }}>
                                    Clinical Governance</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="filterBox">
                        <select name="doctype" class="form-control">
                            <optgroup label="Document Type">
                                <option value="all" selected="true">All</option>
                                <option value="Policy"
                                    {{ ( isset($filter )&& $filter['doctype'] ==='Policy')?"selected":"" }}>
                                    Policy</option>
                                <option value="Form"
                                    {{ ( isset($filter )&& $filter['doctype'] ==='Form')?"selected":"" }}>
                                    Form</option>
                                <option value="Workflow"
                                    {{ ( isset($filter )&& $filter['doctype'] ==='Workflow')?"selected":"" }}>
                                    Workflow</option>
                                <option value="Graphics"
                                    {{ ( isset($filter )&& $filter['doctype'] ==='Graphics')?"selected":"" }}>
                                    Graphics</option>
                                <option value="Position Description"
                                    {{ ( isset($filter )&& $filter['doctype'] ==='Position Description')?"selected":"" }}>
                                    Position Description</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="filterBox">
                        <input type="date" name="filter_date" class="form-control"
                            value="{{ isset($filter )?$filter['filter_date'] :'' }}" />

                    </div>
                    <div class="filterBox">
                        <select name="sort" class="form-control">
                            <optgroup label="Sort By">
                                <option value="latest" selected="true">Newest to Oldest</option>
                                <option value="Sale"
                                    {{ ( isset($filter )&& $filter['sort'] ==='Sale')?"selected":"" }}>
                                    Oldest to Newest</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="DT_Reset">
                        <button class="btn submit" type="submit"><i class="mdi mdi-redo-variant"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
            <div class="addProduct">
                <a id="addmediacontent" href="#"><i class="mdi mdi-plus-circle"></i>Add Document Record</a>
            </div>
        </div> -->
        <div class="card">
            <div class="card-body">
            
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
                <!-- <h4 class="card-title">Records in Document Library</h4> -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Title</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Location/Address</th>
                                <!-- <th>Data Classification</th> -->
                                <!-- <th>Document Format</th> -->
                                <th>Description</th>
                                <th>Status</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @forelse($data as $d)
                                <tr>

                                    <td><img src="{{ url('public/uploads/market_place/'.$d->photo) }}" style="border-radius:0%;width:100px;height:100px;" /></td>
                                    <td class="py-1 doc_name">{{ $d->title }}</td>
                                    <td class="v_number">{{ $d->email }}</td>
                                    <td>{{ $d->phone }}</td>
                                    <td class="">{{ $d->category }}</td>

                                    <td>{{ $d->price }}</td>
                                    <!-- <td class="file_type">{{ $d->document_file_type }}</td> -->
                                    <!-- <td>{{ $d->controlled_number }}</td> -->
                                    <td>{{ $d->address }}</td>
                                    <td class="">{{ $d->description }}</td>
                                    <td class="{{$d->status=='PENDING'?'text-warning':'text-danger'}}">{{ $d->status }}</td>

                                    <td>
                                        <div class="row">
                                            <a href="{{ route('employee-portal.market-place.update_status',['id'=>$d->id,'status'=>'ACCEPT']) }}"
                                                type="button" class="actionLink redBg col-6">
                                                <span class="mdi mdi-checkbox-marked-circle-outline">Approve</span>
                                            </a>
                                            <a href="{{  route('employee-portal.market-place.update_status',['id'=>$d->id,'status'=>'REJECT']) }}"
                                                type="button" class="actionLink col-6">
                                                <span class="mdi mdi-close-box-outline">Reject</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="9" style="text-align: center;"><b>No Records in the
                                            Found!!!</b></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



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