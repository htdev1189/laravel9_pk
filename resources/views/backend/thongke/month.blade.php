@extends('backend.template')

@section('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin_assets/dist/css/adminlte.min.css') }}">


    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <!-- FLOT CHARTS -->
    {{-- <script src="{{ asset('admin_assets/plugins/flot/jquery.flot.js') }}"></script> --}}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Thống kê theo tháng</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    {{-- Thống kê theo bệnh thực tế (AD, Facebook, etc...) --}}
                    <div class="col-md-6">
                        <div id="ajax_content">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i>
                                        Bệnh thực tế
                                    </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="bar-chart" style="height: 300px;"></canvas>
                                    @php
                                        $labels_benhthucte = [];
                                        $data_benhthucte = [];
                                        foreach ($benhthucte_groupBy as $item) {
                                            $benhthucte = $item->BenhThucTe != -1 ? $item->BenhThucTe : 'Khong XD';
                                            array_push($labels_benhthucte, $benhthucte);
                                            array_push($data_benhthucte, $item->tong);
                                        }
                                        // dd(json_encode($data_benhthucte));
                                    @endphp



                                    <script>
                                        var labels = <?php echo json_encode($labels_benhthucte); ?>;
                                        var data = {
                                            labels: labels,
                                            datasets: [{
                                                data: <?php echo json_encode($data_benhthucte); ?>,
                                                backgroundColor: [

                                                    'rgba(75, 192, 192, 0.2)'

                                                ],
                                                borderColor: [

                                                    'rgb(75, 192, 192)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        };


                                        var config = {
                                            type: 'bar',
                                            data: data,
                                            options: {
                                                indexAxis: 'y',
                                            },
                                        };
                                        var myChart = new Chart(
                                            document.getElementById('bar-chart'),
                                            config
                                        );
                                    </script>
                                </div>
                                <!-- /.card-body-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Chọn thời gian:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right" id="reservation">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div id="ajax_content2">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i>
                                        Loại bệnh
                                    </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="loaibenh_bar_chart" style="height: 300px;"></canvas>
                                    @php
                                        $labels_loaibenh = [];
                                        $data_loaibenh = [];
                                        foreach ($loaibenh_groupBy as $item) {
                                            $loaibenh = $item->LoaiBenh != -1 ? $item->LoaiBenh : 'Khong XD';
                                            array_push($labels_loaibenh, $loaibenh);
                                            array_push($data_loaibenh, $item->tong);
                                        }
                                        // dd(json_encode($data_benhthucte));
                                    @endphp


                                    <script>
                                        var labels = <?php echo json_encode($labels_loaibenh); ?>;
                                        var data = {
                                            labels: labels,
                                            datasets: [{
                                                data: <?php echo json_encode($data_loaibenh); ?>,
                                                backgroundColor: [

                                                    'rgba(75, 192, 192, 0.2)'

                                                ],
                                                borderColor: [

                                                    'rgb(75, 192, 192)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        };


                                        var config = {
                                            type: 'bar',
                                            data: data,
                                            options: {
                                                // indexAxis: 'y',
                                            },
                                        };
                                        var myChart = new Chart(
                                            document.getElementById('loaibenh_bar_chart'),
                                            config
                                        );
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection


@section('script')
    <script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin_assets/dist/js/adminlte.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('admin_assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('admin_assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('admin_assets/dist/js/demo.js') }}"></script> --}}

    <script>
        $(document).ready(function() {

            $('#reservation').daterangepicker({});

            // bat buoc phai co khi dung ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#reservation').on('apply.daterangepicker', function(ev, picker) {
                var start = picker.startDate.format('YYYY-MM-DD');
                var finish = picker.endDate.format('YYYY-MM-DD');
                // xy ly phan benh thuc te
                benhthucte(start, finish);
                loaibenh(start, finish);
            });

            // loai benh
            function loaibenh(s, f) {
                $.ajax({
                    url: '/ajax/thongke_range_date_loaibenh',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        start: s,
                        finish: f
                    },
                    success: function(result1) {
                        console.log(result1);
                        // return;
                        document.getElementById('ajax_content2').innerHTML = result1.noidung;

                        var ajax_data_loaibenh = {
                            labels: result1.ajax_labels_loaibenh,
                            datasets: [{
                                data: result1.ajax_data_loaibenh,
                                backgroundColor: [

                                    'rgba(75, 192, 192, 0.2)'

                                ],
                                borderColor: [

                                    'rgb(75, 192, 192)'
                                ],
                                borderWidth: 1
                            }]
                        };


                        var ajax_config_loaibenh = {
                            type: 'bar',
                            data: ajax_data_loaibenh,
                            options: {
                            },
                        };
                        var myChart_loaibenh = new Chart(
                            document.getElementById('bar-chart-loaibenh'),
                            ajax_config_loaibenh
                        );

                    }
                })
            }

            // benh thuc te
            function benhthucte(s, f) {
                $.ajax({
                    url: '/ajax/thongke_range_date',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        start: s,
                        finish: f
                    },
                    success: function(result) {

                        document.getElementById('ajax_content').innerHTML = result.noidung;

                        var ajax_data_benhthucte = {
                            labels: result.ajax_labels_benhthucte,
                            datasets: [{
                                data: result.ajax_data_benhthucte,
                                backgroundColor: [

                                    'rgba(75, 192, 192, 0.2)'

                                ],
                                borderColor: [

                                    'rgb(75, 192, 192)'
                                ],
                                borderWidth: 1
                            }]
                        };


                        var ajax_config_benhthucte = {
                            type: 'bar',
                            data: ajax_data_benhthucte,
                            options: {
                                indexAxis: 'y',
                            },
                        };

                        var myChart = new Chart(
                            document.getElementById('bar-chart-benhthucte'),
                            ajax_config_benhthucte
                        );
                    }
                })
            }


        });
    </script>
@endsection
