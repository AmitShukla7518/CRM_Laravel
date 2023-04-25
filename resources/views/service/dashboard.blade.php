<!DOCTYPE html>
<html lang="en">
@include('utility.head')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('utility.novbaar')
        @include('utility.sidebaar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Upload Excel File</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ url('importExl') }}" method="POST" enctype="multipart/form-data" name="importForm">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="excel_file"
                                        id="exampleInputFile" accept="" required>
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>

                </form>
                <div class="card-footer">

                </div>
                @if (session('duplicateMSG'))
                    <p class="btn btn-danger" id="box">
                        {{ session('duplicateMSG') }}
                    </p>
                @elseif (session('successMSG'))
                    <p class="btn btn-success" id="box">
                        {{ session('successMSG') }}
                    </p>
                @endif
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title">
                            <h1> Uploaded's File Data </h1>
                        </h3>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Goverment ID</th>
                                <th>Email</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        @if (isset($importedData))
                            @foreach ($importedData as $importedData)
                                <tr>
                                    <td>{{ $importedData->id }}</td>
                                    <td>{{ $importedData->EmployeeID }}</td>
                                    <td>{{ $importedData->name }}</td>
                                    <td>{{ $importedData->docID }}</td>
                                    <td>{{ $importedData->email }}</td>
                                    <td>{{ $importedData->address }}</td>
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
                                <th>Name</th>
                                <th>Goverment ID</th>
                                <th>Email</th>
                                <th>Address</th>
                            </tr>
                        </tfoot>
                    </table>
                    {{-- <div class="">{{$employees->links()}}</div> --}}
                </div>

            </div>
        </div>
        @include('utility.footer')
        @include('utility.script')
        @include('utility.dataTable')


        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false
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
