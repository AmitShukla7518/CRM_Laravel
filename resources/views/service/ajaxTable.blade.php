<!DOCTYPE html>
<html lang="en">
@include('utility.head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<title>Show </title>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('utility.novbaar')
        @include('utility.sidebaar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>DataTables</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Ajax Table</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <!-- /.card -->

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Show All Employee(Ajax Table)</h3>
                                    <button type="button" class="btn btn-primary" style="margin-left:74%;"
                                        data-toggle="modal" data-target="#modal-create" id="testing" disabled
                                        hidden>Add
                                        Employee</button>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped yajra-datatable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Employee ID</th>
                                                {{-- <th>Avtar</th> --}}
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Employee ID</th>
                                                {{-- <th>Avtar</th> --}}
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <div class="modal fade" id="modal-Edit">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Modal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form id="UpdateEmp" enctype="multipart/form-data" name="UpdateEmployee">
                                @csrf
                                {{-- @method('put') --}}
                                <div class="card-body">
                                    <input type="text" name="empid" id="emp_id" hidden>
                                    <div class="form-group">
                                        <label for="exampleInputName">Full Name</label>
                                        <input type="text" name="name" id="name1" class="form-control"
                                            placeholder="Enter Full Name">
                                        <div class="nameErr"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" name="email" id="email1" class="form-control"
                                            placeholder="Enter email">
                                        <div class="EmailErr"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputdocID">Government ID </label>
                                        <input type="text" name="docID" id="govID1" class="form-control"
                                            placeholder="Enter Government ID">
                                        <div class="GovDIErr"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Avtar</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile"
                                                    name="image" id="image">
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                    file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" id="submitBTN" class="btn btn-primary">Save changes</button><br>
                            <div class="Loader"></div>


                        </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>

        @include('utility.footer')
        @include('utility.script')


        <script type="text/javascript">
            // $.ajax({
            //     type: "GET",
            //     url: "{{ route('ajax-data') }}",
            //     success: function(response) {
            //         console.log(response);
            //         $('tbody').html("");
            //         $.each(response, function(key, value) {
            //             $('tbody').append(
            //                 '<tr>' +
            //                 '<td>' + value.id + '</td>' +
            //                 '<td>' + value.EmployeeID + '</td>' +
            //                 '<td>' + value.name + '</td>' +
            //                 '<td>' + value.email + '</td>' +
            //                 '<td>' + value.address + '</td>' +
            //                 `<td> <button type="button" class="btn btn-success fas fa-edit"
    //data-toggle="modal" data-target="#modal-Edit" title="Edit" id="editBTN" value="${value.id }"></button>
    //<button type="button" id="deleteBTN" class="btn btn-danger fas fa-trash-alt" value="${value.id }" title="${value.id }" ></button></td>` +
            //                 '</tr>'
            //             );

            //         });

            //     }
            // });


            var datatable = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ajax-data') }}",
                buttons: "copy",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'EmployeeID',
                        name: 'EmployeeID'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
                buttons: [
                    'csv'
                ],
            })
        </script>
        <!--Show Data on Model -->
        <script type="text/javascript">
            $(document).ready(function() {

                $(document).on('click', '#editBTN', function() {
                    var id = $(this).val();
                    $('#modal-Edit').modal('show');
                    $.ajax({
                        type: "GET",
                        url: "{{ url('Show-employee') }}/" + id,
                        success: function(response) {
                            $('#emp_id').val(response.Employee.id)
                            $('#name1').val(response.Employee.name);
                            $('#email1').val(response.Employee.email);
                            $('#govID1').val(response.Employee.docID);
                            //  $('#image').val(response.Employee.image);
                        }
                    });
                });
            });
        </script>
        <!--Update  Employee Through Ajax-->
        <script>
            $('#testing').click(function() {
                alert('Testing clicked....')
            })
            // Submit Model Form 
            $('#submitBTN').click(function(e) {
                e.preventDefault();
                var name = $('#name1').val();
                if (name == '') {
                    $('.nameErr').html(
                        '<span style="color:red;">Enter Your Name!</span>'
                    );
                    $('#name1').focus();
                    return false;
                }
                var email = $('#email1').val();
                if (email == '') {
                    $('.EmailErr').html(
                        '<span style="color:red;">Enter Your Email!</span>'
                    );
                    $('#email1').focus();
                    return false;
                }
                var GovID = $('#govID1').val();
                if (GovID == '') {
                    $('.GovDIErr').html(
                        '<span style="color:red;">Enter Your Goverment ID!</span>'
                    );
                    $('#govID1').focus();
                    return false;
                }
                var id = $('#emp_id').val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('edit-Employee') }}/" + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: "name=" + name + "&email=" + email + "&docID=" + GovID,
                    success: function(response) {
                        $('#modal-Edit').modal('hide');
                        if (response === 'Success') {
                            datatable.draw(); // Data Table Refresh Method
                            $(function() {
                                    toastr.success(` Record has been Update successfully !!`);
                                });
                        } else {
                            toastr.error('Update failed !!');
                        }
                    }
                });
            });
        </script>
        <!-- Delete Employee Through Ajax-->
        <script type="text/javascript">
            $(document).on('click', '#deleteBTN', function() {
                var id = $(this).val();
                if (confirm(`Are you sure You Want to Delete ${id}?`)) {
                    $.ajax({
                        type: "Delete",
                        url: "{{ url('DLT-EMP') }}/" + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response === 'Success') {
                                datatable.draw(); // Data Table Refresh Method
                                $(function() {
                                    toastr.success(` Record has been Delete successfully !!`);
                                });
                            } else {
                                toastr.error('Delete failed !!');
                            }


                        }
                    });
                }
            });
        </script>
