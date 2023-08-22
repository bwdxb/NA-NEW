$(document).ready(function () {
    // Add Todo record
    $('#add_todo').click(function () {

        let todo = $('#todo').val();
        if (todo != '') {
            $.ajax({
                url: "employee-portal/todo",
                type: 'post',
                
                data: {
                    "_token": "{{ csrf_token() }}",
                    "todo": todo
                },
                success: function (response) {
                    console.log(response);
                    if (response.response_code == 200) {
                        todo.val('');
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

    // Update Todo record status
    $(".checkBoxTodo").click(function () {
        var todoId = $(this).prop('value');
        // var status = 'pending';
        // if ($(this).prop('checked')) {
        //     status = 'completed';
        // }

        $.ajax({
            url: 'employee-portal/todo/update/' + todoId,
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

    });

});

// Delete Todo record
function deleteTodo(todoId) {
    $.ajax({
        url: 'employee-portal/todo/delete/' + todoId,
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
        url: 'employee-portal/todo',
        type: 'get',
        dataType: 'json',
        success: function (response) {
            if (response.response_code == 200) {
                $("#todo-op-status").addClass('text-success')
                $.each(response.data, function (key, val) {
                    var code = '';
                    if (val.status == "completed") {
                        code += '<li class="completed"><div class="form-check form-check-flat"><label class="form-check-label"><input class="checkbox checkBoxTodo" type="checkbox" checked>';
                    } else {
                        code += '<li><div class="form-check form-check-flat"><label class="form-check-label"><input class="checkbox checkBoxTodo" type="checkbox">';
                    }
                    code += val.todo + '</label></div><a href="{{url(\'employee-portal/todo/delete/' + val.id + '\'}}"><i class="remove mdi mdi-close-circle-outline"></i></a></li>';
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

