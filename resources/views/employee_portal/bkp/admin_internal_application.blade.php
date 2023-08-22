@extends('layouts.employee_portal.master')

@push('plugin-styles')
@endpush

@section('content')
<style>
.disable{
 cursor: not-allowed;
 pointer-events: none;
}
        /* .table {
                border: 1px solid #ccc;
                border-collapse: collapse;
            }
            .table th, .table td {
                border: 1px solid #ccc;
            }
            .table th, .table td {
                padding: 0.5rem;
                } */
                .draggable {
                    cursor: move;
                    user-select: none;
                }

                .placeholder {
                    background-color: #edf2f7;
                    border: 2px dashed #cbd5e0;
                }

                .clone-list {
                    border-top: 1px solid #ccc;
                }

                .clone-table {
                    border-collapse: collapse;
                    border: none;
                }

                .clone-table th, .clone-table td {
                    border: 1px solid #ccc;
                    border-top: none;
                    padding: 0.5rem;
                }

                .dragging {
                    background: #fff;
                    border-top: 1px solid #ccc;
                    z-index: 999;
                }

            </style>
            <div class="row">
                <div class="col-md-12 d-flex align-items-center justify-content-between">
                    <h1 class="h1_heading">Internal Application

                    </h1>
                    <div class="addProduct">
                        <a id="addmediacontent" href="#" type="button" class="btn btn-primary"><i
                            class="mdi mdi-plus-circle"></i>Add Application</a>
                        </div>
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

                <div class="row">
        <!-- <div class="col-md-12">
            <h1 class="h1_heading">Internal Application</h1>
        </div> -->
        <div class="col-lg-12">
            <div class="form-group">
                <label>Search:</label>

                <input type="text" id="myInput" class="form-control"
                placeholder="Search for a keyword contains in document name or controll number"/>

            </div>
        </div>
    <!-- <div class="col-lg-2">
        <div class="form-group">
            <label>Application 1</label>

            <select style="height:unset;"  class="form-control" placeholder="Select" name="position1">
                <option value="">Position-1</option>
@forelse($data as $d)
        <option value="{{ $d->id }}">{{ $d->title }}</option>
@endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>Application 2</label>
                <select style="height:unset;"  class="form-control" placeholder="Select" name="position2">
                    <option value="">Position-2</option>
@forelse($data as $d)
            <option value="{{ $d->id }}">{{ $d->title }}</option>
@endforeach
                    </select> </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Application 3</label>
                    <select style="height:unset;"  class="form-control" placeholder="Select" name="position3">
                        <option value="">Position-3</option>
@forelse($data as $d)
                <option value="{{ $d->id }}">{{ $d->title }}</option>
@endforeach
                        </select> </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>Application 4</label>
                        <select style="height:unset;"  class="form-control" placeholder="Select" name="position4">
                            <option value="">Position-4</option>
@forelse($data as $d)
                    <option value="{{ $d->id }}">{{ $d->title }}</option>
@endforeach
                            </select> </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Application 5</label>
                            <select style="height:unset;"  class="form-control" placeholder="Select" name="position5">
                                <option value="">Position-5</option>
@forelse($data as $d)
                        <option value="{{ $d->id }}">{{ $d->title }}</option>
@endforeach
                                </select> </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Application 6</label>
                                <select style="height:unset;"  class="form-control" placeholder="Select" name="position6">
                                    <option value="" selected>Position-6</option>
@forelse($data as $d)
                            <option value="{{ $d->id }}">{{ $d->title }}</option>
@endforeach
                                    </select>

                                </div>

                            </div> -->

                            <div class="col-lg-12 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="card-title">Records in Document Library</h4> -->
                                        <form action="{{ route('employee-portal.internal-application.update-dashboard') }}"
                                        method="post">
                                        {{ csrf_field() }}
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>URL</th>
                                                        <th>Logo</th>

                                                        <th>Operations</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <table class="table table-striped" id="table">

                                                <tbody id="myTable">
                                                    @forelse($data as $d)
                                                    <tr>
                                                        <td>
                                                            <input class="form-check-input checkBoxAppClass"
                                                            type="checkbox"
                                                            id="{{$d->id}}"
                                                            @if($d->selected == 1)
                                                            checked
                                                            @endif
                                                            >
                                                            <input id="check{{$d->id}}" type="hidden"
                                                            name="app_ids[]" value="0">
                                                        </td>
                                                        <td>{{ $d->title }}</td>
                                                        <td class="py-1 doc_name"><a href="{{ $d->url }}"
                                                           target="_blank">{{ $d->url }}</a>
                                                       </td>
                                                       <td class="v_number"><img
                                                        src="{{ url('public/'.$d->logo) }}" style="background-color: black;width: 100px;
                                                        height: 100px;border-radius:0%"/></td>

                                                        <td>
                                                            <div class="row">
                                                                <a href="{{ route('employee-portal.internal-application.delete',['id'=>$d->id]) }}"
                                                                 type="button" class="actionLink redBg col-6">
                                                                 <span class="mdi mdi-delete"></span>
                                                             </a>
                                                             <a href="{{ route('employee-portal.internal-application.update',['id'=>$d->id]) }}"
                                                                 type="button" class="actionLink col-6">
                                                                 <span class="mdi mdi-pencil-box-outline"></span>
                                                             </a>
                                                         </div>
                                                     </td>
                                                 </tr>
                                                 @empty
                                                 <tr>
                                                    <td class="text-center" colspan="9"
                                                    style="text-align: center;"><b>No Records in the
                                                    Found!!!</b></td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form_column">
                                        <div class="row">
                                            <div class="btn_column form-group col-md-12 mt-3">
                                                <button id="update6Apps" type="submit" class="default_btn">Update Dashboard Apps</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!----- Add Form----->
                <div id="mediaContentForm"
                style="{{ isset($update)?'':'display:none;' }}">
                <ul class="errorMessages"></ul>
                <div class="row mt-5">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form class="addProductForm"
                                action="{{ route('employee-portal.internal-application.create') }}"
                                method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="id"
                                value="{{ old('id') ? old('id'): ( isset($update->id) ? $update->id : '') }}"
                                class="form-control">

                                <input type="hidden" name="op_type"
                                value="{{ isset($update->id) ? 'update' : 'create' }}"
                                class="form-control">


                                <div class="form_column">
                                    <h5>{{ isset($update)?"Update":"Add" }} Internal
                                    Application</h5>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="title"
                                            value="{{ (old('title')) ? old('title'): (isset($update->title)?$update->title:'') }}"
                                            required>
                                            @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Url</label>
                                            <input type="text" class="form-control" name="url"
                                            value="{{ (old('url')) ? old('url'): (isset($update->url)?$update->url:'') }}"
                                            required>
                                            @error('url')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <div class="custom-file">
                                                <label for="exampleFormControlFile1">Upload Photo *</label>
                                                <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                                name="logo"
                                                {{ isset($update)?'':'required' }}>
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
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

        <script>


            // alert('#'+items.length);

            function updateButtonStatus(){

                var n = $( "input:checked" ).length;
                // alert('#'+n);
                $('#update6Apps').prop('disabled', true);
                $('#update6Apps').addClass("disable");
                $('#update6Apps').text('6 Apps should be selected for Dashboard')
                if (n == 6) {
                    $('#update6Apps').prop('disabled', false);
                    $('#update6Apps').removeClass("disable");
                    $('#update6Apps').text('Update Dashboard Apps')
                }else if (n > 6) {
                    $('#update6Apps').text('Only 6 Apps should be selected')
                }
            }



            $(document).ready(function () {
                // items = document.getElementsByClassName('checkBoxAppClass');
                items =  $( "input:checked" );
                $.each(items, function (index, item) {
                    var itemId = '#' + item.id;
                    var itemElement = $(itemId);
                    console.log(index, itemId, itemElement.prop('checked'),itemElement,$('#check' + item.id).prop('value'))

                    if (itemElement.prop('checked')) {
                        if (itemElement.prop('checked')) {
                            $('#check' + item.id).prop('value', "" + item.id)
                        } else {
                            $('#check' + item.id).prop('value', "0")
                        }
                    }
                });

                updateButtonStatus();
                
                $(".checkBoxAppClass").click(function () {
                    items = document.getElementsByClassName('checkBoxAppClass');
                    var id = $(this).prop('id');
                    if (id) {
                        if ($(this).prop('checked')) {
                            $('#check' + id).prop('value', "" + id)
                        } else {
                            $('#check' + id).prop('value', "0")
                        }
                    }
                    updateButtonStatus();
                });


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
        // var createAllErrors = function () {
        //     var form = $(this),
        //         errorList = $("ul.errorMessages", form);

        //     var showAllErrorMessages = function () {
        //         errorList.empty();

        //         // Find all invalid fields within the form.
        //         var invalidFields = form.find(":invalid").each(function (index, node) {

        //             // Find the field's corresponding label
        //             var label = node.name,
        //                 // Opera incorrectly does not fill the validationMessage property.
        //                 message = node.validationMessage || 'Invalid value.';
        //             // $(this).parent('div').append("<span class='text-danger'>" +  message + "</span>");

        //             errorList
        //                 .show()
        //                 .append("<li><span>" + label + "</span> " + message + "</li>");
        //         });
        //     };

        //     // Support Safari
        //     form.on("submit", function (event) {
        //         if (this.checkValidity && !this.checkValidity()) {
        //             $(this).find(":invalid").first().focus();
        //             event.preventDefault();
        //         }
        //     });

        //     $("input[type=submit], button:not([type=button])", form)
        //         .on("click", showAllErrorMessages);

        //     $("input", form).on("keypress", function (event) {
        //         var type = $(this).attr("type");
        //         if (/date|email|month|number|search|tel|text|time|url|week/.test(type) &&
        //             event.keyCode == 13) {
        //             showAllErrorMessages();
        //         }
        //     });
        // };

        // $("form").each(createAllErrors);
    </script>


    <!-- Drag and drop Table Row -->
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('table');

            let draggingEle;
            let draggingRowIndex;
            let placeholder;
            let list;
            let isDraggingStarted = false;

            // The current position of mouse relative to the dragging element
            let x = 0;
            let y = 0;

            // Swap two nodes
            const swap = function (nodeA, nodeB) {
                const parentA = nodeA.parentNode;
                const siblingA = nodeA.nextSibling === nodeB ? nodeA : nodeA.nextSibling;

                // Move `nodeA` to before the `nodeB`
                nodeB.parentNode.insertBefore(nodeA, nodeB);

                // Move `nodeB` to before the sibling of `nodeA`
                parentA.insertBefore(nodeB, siblingA);
            };

            // Check if `nodeA` is above `nodeB`
            const isAbove = function (nodeA, nodeB) {
                // Get the bounding rectangle of nodes
                const rectA = nodeA.getBoundingClientRect();
                const rectB = nodeB.getBoundingClientRect();

                return (rectA.top + rectA.height / 2 < rectB.top + rectB.height / 2);
            };

            const cloneTable = function () {
                const rect = table.getBoundingClientRect();
                const width = parseInt(window.getComputedStyle(table).width);

                list = document.createElement('div');
                list.classList.add('clone-list');
                list.style.position = 'absolute';
                list.style.left = `${rect.left}px`;
                list.style.top = `${rect.top}px`;
                table.parentNode.insertBefore(list, table);

                // Hide the original table
                table.style.visibility = 'hidden';

                table.querySelectorAll('tr').forEach(function (row) {
                    // Create a new table from given row
                    const item = document.createElement('div');
                    item.classList.add('draggable');

                    const newTable = document.createElement('table');
                    newTable.setAttribute('class', 'clone-table');
                    newTable.style.width = `${width}px`;

                    const newRow = document.createElement('tr');
                    const cells = [].slice.call(row.children);
                    cells.forEach(function (cell) {
                        const newCell = cell.cloneNode(true);
                        newCell.style.width = `${parseInt(window.getComputedStyle(cell).width)}px`;
                        newRow.appendChild(newCell);
                    });

                    newTable.appendChild(newRow);
                    item.appendChild(newTable);
                    list.appendChild(item);
                });
            };

            const mouseDownHandler = function (e) {
                // Get the original row
                const originalRow = e.target.parentNode;
                draggingRowIndex = [].slice.call(table.querySelectorAll('tr')).indexOf(originalRow);

                // Determine the mouse position
                x = e.clientX;
                y = e.clientY;

                // Attach the listeners to `document`
                document.addEventListener('mousemove', mouseMoveHandler);
                document.addEventListener('mouseup', mouseUpHandler);
            };

            const mouseMoveHandler = function (e) {
                if (!isDraggingStarted) {
                    isDraggingStarted = true;

                    cloneTable();

                    draggingEle = [].slice.call(list.children)[draggingRowIndex];
                    draggingEle.classList.add('dragging');

                    // Let the placeholder take the height of dragging element
                    // So the next element won't move up
                    placeholder = document.createElement('div');
                    placeholder.classList.add('placeholder');
                    draggingEle.parentNode.insertBefore(placeholder, draggingEle.nextSibling);
                    placeholder.style.height = `${draggingEle.offsetHeight}px`;
                }

                // Set position for dragging element
                draggingEle.style.position = 'absolute';
                draggingEle.style.top = `${draggingEle.offsetTop + e.clientY - y}px`;
                draggingEle.style.left = `${draggingEle.offsetLeft + e.clientX - x}px`;

                // Reassign the position of mouse
                x = e.clientX;
                y = e.clientY;

                // The current order
                // prevEle
                // draggingEle
                // placeholder
                // nextEle
                const prevEle = draggingEle.previousElementSibling;
                const nextEle = placeholder.nextElementSibling;

                // The dragging element is above the previous element
                // User moves the dragging element to the top
                // We don't allow to drop above the header
                // (which doesn't have `previousElementSibling`)
                if (prevEle && prevEle.previousElementSibling && isAbove(draggingEle, prevEle)) {
                    // The current order    -> The new order
                    // prevEle              -> placeholder
                    // draggingEle          -> draggingEle
                    // placeholder          -> prevEle
                    swap(placeholder, draggingEle);
                    swap(placeholder, prevEle);
                    return;
                }

                // The dragging element is below the next element
                // User moves the dragging element to the bottom
                if (nextEle && isAbove(nextEle, draggingEle)) {
                    // The current order    -> The new order
                    // draggingEle          -> nextEle
                    // placeholder          -> placeholder
                    // nextEle              -> draggingEle
                    swap(nextEle, placeholder);
                    swap(nextEle, draggingEle);
                }
            };

            const mouseUpHandler = function () {
                // Remove the placeholder
                placeholder && placeholder.parentNode.removeChild(placeholder);

                draggingEle.classList.remove('dragging');
                draggingEle.style.removeProperty('top');
                draggingEle.style.removeProperty('left');
                draggingEle.style.removeProperty('position');

                // Get the end index
                const endRowIndex = [].slice.call(list.children).indexOf(draggingEle);

                isDraggingStarted = false;

                // Remove the `list` element
                list.parentNode.removeChild(list);

                // Move the dragged row to `endRowIndex`
                let rows = [].slice.call(table.querySelectorAll('tr'));
                draggingRowIndex > endRowIndex
                    ? rows[endRowIndex].parentNode.insertBefore(rows[draggingRowIndex], rows[endRowIndex])
                    : rows[endRowIndex].parentNode.insertBefore(rows[draggingRowIndex], rows[endRowIndex].nextSibling);

                // Bring back the table
                table.style.removeProperty('visibility');

                // Remove the handlers of `mousemove` and `mouseup`
                document.removeEventListener('mousemove', mouseMoveHandler);
                document.removeEventListener('mouseup', mouseUpHandler);
            };

            table.querySelectorAll('tr').forEach(function (row, index) {
                // Ignore the header
                // We don't want user to change the order of header
                if (index === 0) {
                    return;
                }

                const firstCell = row.firstElementChild;
                firstCell.classList.add('draggable');
                firstCell.addEventListener('mousedown', mouseDownHandler);
            });
        });
    </script> -->
    @endsection

    @push('plugin-scripts')
    @endpush

    @push('custom-scripts')
    @endpush