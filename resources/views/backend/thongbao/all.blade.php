@php
    use Illuminate\Database\Eloquent\ModelNotFoundException;
@endphp
@extends('backend.template')

@section('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin_assets/dist/css/adminlte.min.css') }}">

    <style>
        span.notice-not-seen {
            color: red;
        }

        span.notice-seen {
            color: green;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Quản lý thông báo</h1>
                    </div><!-- /.col -->
                    @if (Session::get('current_user')->group == 1)
                        <div class="col-sm-6">
                            <a href="/admin/thongbao/add" class="btn btn-success float-right ">Thêm thông báo</a>
                        </div><!-- /.col -->
                    @endif
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>From</th>
                                            @if (Session::get('current_user')->group == 1)
                                                <th>To</th>
                                            @endif
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($allNotice as $notice)
                                            <tr>
                                                <td>{{ $notice->id }}</td>
                                                <td>{{ $notice->title }}</td>
                                                <td>{{ App\Models\Thongbao::find($notice->id)->admin->name }}</td>
                                                @if (Session::get('current_user')->group == 1)
                                                    <td>
                                                        @php
                                                            $admin_string = '';
                                                            $admins = json_decode($notice->to);
                                                            foreach ($admins as $key => $value) {
                                                                $stt = $value == 1 ? "<span class='notice-seen'>seen</span>" : "<span class='notice-not-seen'>not seen</span>";
                                                                $admin_string .= App\Models\Admin::find($key)->name . '(' . $stt . ') </br>';
                                                            }
                                                            echo trim($admin_string);
                                                        @endphp
                                                    </td>
                                                @endif
                                                <td>{{ $notice->created_at }}</td>
                                                <td>

                                                    <a class="show_notice" href="" class="mr-1"
                                                        data-id="{{ $notice->id }}"><i class="fa fa-eye"></i></a>
                                                    @if (Session::get('current_user')->group == 1)
                                                        <a onclick="return confirm('Want to delete?');"
                                                            href="/admin/thongbao/delete/{{ $notice->id }}"
                                                            class="mr-1"><i class="fa fa-trash"></i></a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

    <div class="modal fade" id="modal-default">

    </div>
@endsection


@section('script')
    <!-- jQuery -->
    <script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin_assets/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin_assets/dist/js/demo.js') }}"></script>
    <!-- Page specific script -->
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
            });



        });

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.show_notice').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    url: '/admin/thongbao/ajax',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        document.getElementById('modal-default').innerHTML = response.noidung;
                        $('#modal-default').modal();
                    }
                });
            });
        });
    </script>
@endsection
