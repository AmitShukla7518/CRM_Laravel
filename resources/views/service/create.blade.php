<!DOCTYPE html>
<html lang="en">
@include('utility.head')
<title>Add Employee</title>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('utility.novbaar')
        @include('utility.sidebaar')
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Validation</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Add Employee</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- jquery validation -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Add Employee <small>jQuery Validation</small></h3>
                                </div>
                                <form id="createEmp" action="{{ route('create') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputName">Full Name</label>
                                            <input type="text" name="name" class="form-control"
                                                id="exampleInputName" placeholder="Enter Full Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" name="email" class="form-control"
                                                id="exampleInputEmail1" placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputdocID">Government ID </label>
                                            <input type="text" name="docID" class="form-control"
                                                id="exampleInputdocID" placeholder="Enter Government ID ">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Avtar</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        id="exampleInputFile" name="image">
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
                                                id="exampleInputPassword1" placeholder="Password" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Confirm Password</label>
                                            <input type="password" name="cnfrmpassword" class="form-control"
                                                id="exampleInputPassword2" placeholder="Confirm Password" disabled>
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
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @include('utility.footer')
    @include('utility.script')
    <!-- jquery-validation -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            $.validator.setDefaults({
                submitHandler: function() {
                    document.forms["createEmp"].submit();
                }
            });
            $('#createEmp').validate({
                rules: {

                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    terms: {
                        required: true
                    },
                    docID: {
                        required: true,
                        minlength: 10,
                        // regex: /^[A-Za-z0-9]{6,15}$/
                    },
                    address: {
                        required: true,
                        minlength: 3,
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
                        password: {
                            required: "Please provide  password",
                            minlength: "Your password must be at least 5 characters long"
                        },
                    docID: {
                        required: "Please provide  Document ID",
                        minlength: "Your password must be at least 10 characters long"
                        // pattern: " Please provide a Document ID In alphanumeric format"
                    },
                    address: {
                        required: "Please provide  Address",
                        minlength: "Your Address must be at least 3 characters long"
                        // pattern: " Please provide a Document ID In alphanumeric format"
                    },
                    terms: "Please accept our terms"
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
</body>

</html>
