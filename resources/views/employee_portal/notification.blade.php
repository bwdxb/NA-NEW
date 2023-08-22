@extends('layouts.employee_portal.master')

@push('plugin-styles')
@endpush

@section('content')
@php
        use app\Http\helper\Helper as Helper;
        $notifications = Helper::getMyNotifications();
    @endphp
    <div class="row mt-4">
        <div class="col-md-12 d-flex align-items-center justify-content-between">
            <h1 class="h1_heading">Notifications</h1>
        </div>
    </div>


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
    <div class="row mt-4">
        <div class="col-xl-12 col-sm-12">
          

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Notifications</h4>
                    <div class="table-responsive">
                                            <table class="table table-striped adminTable">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Type</th>
                                                    <th>Created</th>
                                                    
                                                </tr>
                                                </thead>
                                                <tbody id="myTable">
                                                @forelse($notifications as $key=>$d)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$d->title}}</td>
                                                        <td>{{$d->description}}</td>
                                                        <td>{{$d->type}}</td>
                                                        <td>{{\Carbon\Carbon::parse($d->created_at)->diffForHumans()}}</td>
                                                        <td><a href="{{$d->url?$d->url:'#'}}">Visit</a></td>
                                                       
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center" colspan="5"
                                                            style="text-align: center;">
                                                            <b>You don't have any notifications.</b>
                                                        </td>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="{{asset('public/api-routes/todo-api-routes.js')}}"></script> -->
<script>
    $(document).ready(function () {
        fetchTodos();
        // Add Todo record
        $('#add_todo').click(function () {

            var todo = $('#todo').val();
            var todoDate = $('#todo-date').val();
            if (todo != '') {
                $.ajax({
                    url: "{{route('employee-portal.todo.create')}}",
                    type: 'post',

                    data: {
                        "_token": "{{ csrf_token() }}",
                        "todo": todo,
                        "date": todoDate,
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.response_code == 200) {
                            $('#todo').val('');
                            $("#todo-op-status").addClass('text-success')
                        } else {
                            $("#todo-op-status").addClass('text-danger')
                        }
                        $("#todo-op-status").html(response.response_message)
                        $("#todo-op-status").show().delay(5000).queue(function (n) {
                            $(this).hide();
                            n();
                        });
                        fetchTodos();
                    },
                    error: function (response) {
                        console.log(response)
                        $("#todo-op-status").addClass('text-danger')
                        //$("#todo-op-status").html(response)
                        $("#todo-op-status").show().delay(5000).queue(function (n) {
                            $(this).hide();
                            n();
                        });
                        // fetchTodos();

                    }
                });
            } else {
                $("#todo-op-status").addClass('text-danger')
                $("#todo-op-status").html('Fill in the Todo !!!')
                $("#todo-op-status").show().delay(5000).queue(function (n) {
                    $(this).hide();
                    n();
                });
                fetchTodos();
            }
        });
    });

    // Delete Todo record
    function deleteTodo(todoId) {
        $.ajax({
            url: "{{route('employee-portal.todo.fetch')}}/delete/" + todoId,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                if (response.response_code == 200) {
                    $("#todo-op-status").addClass('text-success')
                } else {
                    $("#todo-op-status").addClass('text-danger')
                }

                $("#todo-op-status").html(response.response_message)
                $("#todo-op-status").show().delay(5000).queue(function (n) {
                    $(this).hide();
                    n();
                });
                fetchTodos();
            },
            error: function (response) {
                console.log(response)
                $("#todo-op-status").addClass('text-danger')
                //$("#todo-op-status").html(response)
                $("#todo-op-status").show().delay(5000).queue(function (n) {
                    $(this).hide();
                    n();
                });
                fetchTodos();
            }
        });
    }

    // Delete Todo record
    function updateTodo(todoId) {
        $.ajax({
            url: "{{route('employee-portal.todo.fetch')}}/update/" + todoId,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                if (response.response_code == 200) {
                    $("#todo-op-status").addClass('text-success')
                } else {
                    $("#todo-op-status").addClass('text-danger')
                }

                $("#todo-op-status").html(response.response_message)
                $("#todo-op-status").show().delay(5000).queue(function (n) {
                    $(this).hide();
                    n();
                });
                fetchTodos();
            },
            error: function (response) {
                console.log(response)
                $("#todo-op-status").addClass('text-danger')
                //$("#todo-op-status").html(response)
                $("#todo-op-status").show().delay(5000).queue(function (n) {
                    $(this).hide();
                    n();
                });
                fetchTodos();
            }
        });
    }


    // Fetch records
    function fetchTodos() {
        $.ajax({
            url: '{{route('employee-portal.todo.fetch.all')}}',
            type: 'get',
            dataType: 'json',
            success: function (response) {
                if (response.response_code == 200) {
                    $("#todo-op-status").addClass('text-success')
                    $("#todo-list").empty()
                    $.each(response.data, function (key, val) {
                        var code = '';
                        if (val.status == "completed") {
                            code += '<li class="completed">' +
                                '<div class="form-check form-check-flat">' +
                                '<input class="checkbox" onchange="updateTodo(' + val.id + ')" type="checkbox" checked />' +
                                '<label class="form-check-label">' + val.todo + ' (' + moment(val.date).format('DD/MM/Y') + ')</label>' +
                                '<p><strong>Created at:</strong> <span>' + moment(val.created_at).format('DD/MM/Y, h:mm:ss a')+ '</span> <br/> ' +
                                '</div>' +
                                '<i class="remove mdi mdi-close-circle-outline" style="cursor:pointer;" onclick="deleteTodo(' + val.id + ')"></i>' +
                                '</li>';
                        } else {
                            code += '<li>' +
                                '<div class="form-check form-check-flat">' +
                                '<input class="checkbox" onchange="updateTodo(' + val.id + ')" type="checkbox" />' +
                                '<label class="form-check-label">' + val.todo + ' (' + moment(val.date).format('DD/MM/Y') + ')</label>' +
                                '<p><strong>Created at:</strong> <span>' + moment(val.created_at).format('DD/MM/Y, h:mm:ss a')+ '</span> <br/> ' +
                                '</div>' +
                                '<i style="cursor: not-allowed" class="remove mdi mdi-close-circle-outline"></i></li>';
                        }

                        $("#todo-list").append(code);
                    });
                } else {
                    $("#todo-op-status").addClass('text-danger')
                }

                $("#todo-op-status").html(response.response_message)
                $("#todo-op-status").show().delay(5000).queue(function (n) {
                    $(this).hide();
                    n();
                });
            },
            error: function (response) {
                console.log(response)
                $("#todo-op-status").addClass('text-danger')
                //$("#todo-op-status").html(response)
                $("#todo-op-status").show().delay(5000).queue(function (n) {
                    $(this).hide();
                    n();
                });
                fetchTodos();
            }
        });
    }
    $( function() {
        $( "#todo-date" ).datepicker({
            dateFormat: "dd-mm-yy"
            ,	duration: "fast"
        });
    } );


</script>

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush