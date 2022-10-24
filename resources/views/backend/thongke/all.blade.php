@extends('backend.template')

@section('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin_assets/dist/css/adminlte.min.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Thống Kê</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    {{-- thong ke thang hien tai  --}}
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <p>Tháng @php
                                    echo 8 . '/' . date('Y');
                                @endphp</p>
                                <hr>
                                <h5>Số người liên hệ Pk để đặt hẹn: {{ $contact_current_month }}</h5>
                                <h5>Số người dat hen va den kham trong thang: {{ $contactAndorder_current_month }}</h5>
                                <h5>Số người dat hen va khong den kham trong thang: {{ $contactAndNotorder_current_month }}
                                </h5>
                                <hr>
                                <h5>Đặt hẹn tới trong tháng: {{ $order_current_month }}</h5>
                                <h5>Hủy: {{ $cancel_current_month }}</h5>
                                <h5>Tới khám trong tháng: {{ $came_current_month }}</h5>
                                <h5>Đang tới: {{ $comming_current_month }}</h5>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="/admin/thongke/month" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    {{-- noi dung moi se nam trong nay --}}
                    @foreach ($tong_denkham_2022 as $item)
                        <!-- LINE CHART -->
                        <div class="card card-info w-100 mb-5">
                            <div class="card-header">
                                <h3 class="card-title">{{ $item->TenCK }}</h3>

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
                                <div class="chart">
                                    <canvas id="myChart-{{ $item->idCK }}" height="100px"></canvas>
                                    @php
                                        $tong_denkham_theoThang = DB::connection('mysqldh')
                                            ->table('dathen')
                                            ->selectRaw('count(ID_DatHen) as tong, MONTH(NgayGioDenKham) month')
                                            ->where([['TinhTrang', '=', '0'], ['DaDen', '=', '1'], ['idCK', '=', $item->idCK]])
                                            ->whereYear('NgayGioDenKham', '2022')
                                            ->groupBy('month')
                                            ->get();
                                        $label = [];
                                        $data = [];
                                        foreach ($tong_denkham_theoThang as $value) {
                                            array_push($label, 'Tháng ' . $value->month);
                                            array_push($data, $value->tong);
                                        }
                                        
                                    @endphp
                                    <script>
                                        var labels = <?php echo json_encode($label); ?>;
                                        var data = {
                                            labels: labels,
                                            datasets: [{
                                                label: 'My First dataset',
                                                backgroundColor: 'rgb(255, 99, 132)',
                                                borderColor: 'rgb(255, 99, 132)',
                                                data: <?php echo json_encode($data); ?>,
                                            }]
                                        };

                                        var config = {
                                            type: 'line',
                                            data: data,
                                            options: {

                                            }
                                        };


                                        var myChart = new Chart(
                                            document.getElementById('myChart-{{ $item->idCK }}'),
                                            config
                                        );
                                    </script>

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    @endforeach


                    // chart multiline

                    <div class="card card-info w-100 mb-5">
                        <div class="card-header">
                            <h3 class="card-title">multiline</h3>

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
                            <div class="chart">
                                <canvas id="myChart-multiLine" height="100px"></canvas>
                            </div>
                        </div>

                        <script>
                            @php
                                $tong_denkham_theoThang = DB::connection('mysqldh')
                                    ->table('dathen')
                                    ->selectRaw('count(ID_DatHen) as tong, MONTH(NgayGioDenKham) month')
                                    ->where([['TinhTrang', '=', '0'], ['DaDen', '=', '1'], ['idCK', '=', '1']])
                                    ->whereYear('NgayGioDenKham', '2022')
                                    ->groupBy('month')
                                    ->get();
                                $label = [];
                                foreach ($tong_denkham_theoThang as $value) {
                                    array_push($label, 'Tháng ' . $value->month);
                                }
                                $tk_multiline = [];
                                foreach ($tong_denkham_2022 as $key => $value) {
                                    $tong_denkham_tungthang = DB::connection('mysqldh')
                                        ->table('dathen')
                                        ->selectRaw('count(ID_DatHen) as tong, MONTH(NgayGioDenKham) month')
                                        ->where([['TinhTrang', '=', '0'], ['DaDen', '=', '1'], ['idCK', '=', $value->idCK]])
                                        ->whereYear('NgayGioDenKham', '2022')
                                        ->groupBy('month')
                                        ->get();
                                
                                    $data = [];
                                    foreach ($tong_denkham_tungthang as $v1) {
                                        array_push($data, $v1->tong);
                                    }
                                
                                    $tk_multiline[$key]['label'] = $value->TenCK;
                                    $tk_multiline[$key]['data'] = $data;
                                    $tk_multiline[$key]['borderColor'] = 'rgb(255, 99, 132)';
                                    $tk_multiline[$key]['backgroundColor'] = 'rgb(255, 99, 132)';
                                    $tk_multiline[$key]['yAxisID'] = 'y';
                                }
                            @endphp

                            var labels = <?php echo json_encode($label); ?>;
                            var data = {
                                labels: labels,
                                datasets: <?php echo json_encode($tk_multiline); ?>
                            };

                            var config = {
                                type: 'line',
                                data: data,
                                options: {
                                    responsive: true,
                                    interaction: {
                                        mode: 'index',
                                        intersect: false,
                                    },
                                    stacked: false,
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: 'Chart.js Line Chart - Multi Axis'
                                        }
                                    },
                                    scales: {
                                        y: {
                                            type: 'linear',
                                            display: true,
                                            position: 'left',
                                        },
                                    }
                                },
                            };

                            var myChart = new Chart(
                                document.getElementById('myChart-multiLine'),
                                config
                            );
                        </script>
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
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('admin_assets/dist/js/demo.js') }}"></script> --}}
@endsection
