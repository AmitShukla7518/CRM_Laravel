<!DOCTYPE html>
<html lang="en">
@include('utility.head')
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
                                <li class="breadcrumb-item active">Show</li>
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
                                    <h3 class="card-title">Show All Employee</h3>
                                    <button type="button" class="btn btn-primary" style="margin-left:74%;"
                                        data-toggle="modal" data-target="#modal-create" disabled>Add
                                        Employee</button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Employee ID</th>
                                                <th>Avtar</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        @if ($employees->isNotEmpty())
                                            @foreach ($employees as $employee)
                                                <tr>
                                                    <td>{{ $employee->id }}</td>
                                                    <td>{{ $employee->EmployeeID }}</td>
                                                    <td>
                                                        @if ($employee->image != '' && $employee->image != null)
                                                            <img src="{{ asset('uploads/employees/' . $employee->image) }}"
                                                                alt="user-img" width="35" height="35"
                                                                class="rounded-circle">
                                                        @else
                                                            <img src="{{ asset('uploads/employees/no-image.jpg' . $employee->image) }}"
                                                                alt="user-img" width="35" height="35"
                                                                class="rounded-circle">
                                                        @endif
                                                    </td>
                                                    <td>{{ $employee->name }}</td>
                                                    <td>{{ $employee->email }}</td>
                                                    <td>
                                                        <div>
                                                            <button type="button" class="btn btn-success fas fa-edit"
                                                                data-toggle="modal" data-target="#modal-Edit"
                                                                title="Edit" value="{{ $employee->id }}"
                                                                onclick="" id="editBTN"></button>
                                                            <button
                                                                type="button"class="btn btn-danger fas fa-trash-alt"
                                                                id="deleteBTN" title="Delete {{ $employee->id }}"
                                                                onclick="deleteEmployee()"></button>
                                                            <form
                                                                id="Employee-edit-section-{{ $employee->id }}"action="{{ route('manageEmp.destroy', $employee->id) }}"
                                                                method="POST" name="DeleteForm">
                                                                @csrf
                                                                @method('DELETE')

                                                            </form>


                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6"> Record Not Found </td>
                                            </tr>
                                        @endif
                                        <tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Employee ID</th>
                                                <th>Avtar</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    {{-- <div class="">{{$employees->links()}}</div> --}}
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>




        <!--Model Start-->

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
                        <form id="UpdateEmp" action="{{ route('update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <input type="text" name="empid" id="emp_id" hidden>
                                <div class="form-group">
                                    <label for="exampleInputName">Full Name</label>
                                    <input type="text" name="name" id="name1" class="form-control"
                                        placeholder="Enter Full Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" id="email1" class="form-control"
                                        placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputdocID">Government ID </label>
                                    <input type="text" name="docID" id="govID1" class="form-control"
                                        placeholder="Enter Government ID ">
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
                        <button type="button" class="btn btn-primary" onclick="update()">Save changes</button>
                    </div>
                    </form>
                </div>

            </div>

        </div>
        <!--Edit Model-->
        <div class="modal fade" id="modal-create">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="createEmp" action="{{ route('create') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputName">Full Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputName"
                                        placeholder="Enter Full Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control"
                                        id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputdocID">Government ID </label>
                                    <input type="text" name="docID" class="form-control" id="exampleInputdocID"
                                        placeholder="Enter Government ID ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Avtar</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile"
                                                name="image">
                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputaddress">permanent Address</label>
                                    <input type="text" name="address" class="form-control"
                                        id="exampleInputaddress" placeholder="Enter Government ID ">
                                </div>
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>State</label>
                                    <select class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="password" class="form-control"
                                        id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Confirm Password</label>
                                    <input type="password" name="cnfrmpassword" class="form-control"
                                        id="exampleInputPassword2" placeholder="Confirm Password">
                                </div>
                                <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="terms" class="custom-control-input"
                                            id="exampleCheck1">
                                        <label class="custom-control-label" for="exampleCheck1">I agree to the
                                            <a href="#">terms of service</a>.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Model End -->

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <!--For Logout-->
    <script>
        function logout() {
            if (confirm("Are you sure You Want to Logout ?")) {
                document.forms["logOutForm"].submit();
            }
        }
    </script>
    <script>
        function logout() {
            if (confirm("Are you sure You Want to Logout ?")) {
                document.forms["logOutForm"].submit();
            }
        }
    </script>
    <script>
        function deleteEmployee(id) {
            console.warn(id);
            if (confirm("Are you sure You Want to Delete ?")) {
                //document.getElementById("Employee-delete-section-"+id).submit();
                document.forms["DeleteForm"].submit();
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#editBTN', function() {
                var id = $(this).val();
                $('#modal-Edit').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{ url('Show-employee') }}/" + id,
                    success: function(response) {
                        console.log(response.Employee.docID);
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
    <script>
        function update() {
            document.forms["UpdateEmp"].submit();
        }
    </script>
    <!--Toastr-->
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            @if (Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @elseif (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @elseif (Session::has('info'))
                toastr.info("{{ Session::get('info') }}");
            @endif
        });
    </script>
    <!--Validation-->
    <!-- jquery-validation -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            $.validator.setDefaults({
                submitHandler: function() {
                    document.forms["UpdateEmp"].submit();
                }
            });
            $('#UpdateEmp').validate({
                rules: {

                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    docID: {
                        required: true,
                        minlength: 10,
                        // regex: /^[A-Za-z0-9]{6,15}$/
                    }
                },
                messages: {
                    name: {
                        required: "Please provide Name",
                        minlength: "Your Name must be at least 3 characters long"
                    },
                    email: {
                        required: "Please enter  email address",
                        email: "Please enter a valid email address"
                    },
                    docID: {
                        required: "Please provide  Document ID",
                        minlength: "Your password must be at least 10 characters long"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>


</body>

</html>
