@extends('layouts.employee_portal.master')

@push('plugin-styles')

@endpush

@section('content')
<div class="row mt-4">
    <div class="col-md-12 d-flex align-items-center justify-content-between">
        <h1 class="h1_heading">Internal Application</h1>
    </div>
</div>


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
<div class="row mt-4">
    @forelse($data as $d)
        <div class="col-xl-3 col-sm-4">
            <div class="card navyblueBG mb-4 appLogo">
                <a class="card-body linkItem hoverEffect" href="{{ $d->url }}" target="_blank">
                    <img class="imgHover" src="{{ url('public/'.$d->logo) }}">
                    <h5 class="text-white">{{ $d->title }}</h5>
                </a>
            </div>
        </div>
    @endforeach

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
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
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
<script
            src="{{ asset('public/employee_portal/assets/plugins/chartjs/chart.min.js') }}">
    </script>
    <script
            src="{{ asset('public/employee_portal/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}">
    </script>
@endpush

@push('custom-scripts')
@endpush