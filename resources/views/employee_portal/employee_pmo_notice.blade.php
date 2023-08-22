@extends('layouts.employee_portal.master')
@php
    use app\Http\helper\Helper as Helper;
@endphp
@push('plugin-styles')
@endpush

@section('content')

<div class="row">
    <div class="col-md-12">
        <img class="imgHover" src="{{ url('public/uploads/pmo/'.$update->banner_img) }}">
    </div>
    <form action="{{route('employee-portal.pmo-notice-board.view','id='.$update->id) }}" class="w-100" method="get">

    <div class="col-md-12 formgroup">
    <label class="filterTxt mr-2">Search:</label>
        <div class="filterBox w-100">
            <input type="hidden" name="id" id="id" value="{{$update->id}}">
            <input type="text" name="search_key" class="form-control w-100 docSearch" value="{{Request::get('search_key')}}" placeholder="Search documents by their controlled number, file name or keywords" />
        </div>
    </div>
    </form>
    <div class="col-lg-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="card-title">Records in Document Library</h4> -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Document Name</th>
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @forelse($data as $d)
                                <tr>
                                    <td class="py-1 doc_name search">{{ $d->document }}</td>
                                    <td class="file_link"><a
                                            href="{{url('public/uploads/pmo/'.$d->document)}}" target="_blank" class="doc_button">View</a>&nbsp;&nbsp;&nbsp;<a
                                            href="{{url('public/uploads/pmo/'.$d->document)}}"
                                            class="doc_button" download="{{ $d->document}}"><i aria-hidden="true"
                                                class="mdi mdi-cloud-download-outline mr-2"></i>Download</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="9" style="text-align: center;"><b>No Records in the
                                            PMO Notice!!!</b></td>
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