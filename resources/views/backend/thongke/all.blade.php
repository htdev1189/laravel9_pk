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

                    <!-- thong ke so bstv -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $all_bstv->count() }}</h3>

                                <p>Tư vấn viên</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
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
                                        // dd($tong_denkham_theoThang);
                                        $label = [];
                                        $data = [];
                                        foreach ($tong_denkham_theoThang as $value) {
                                            array_push($label, 'Tháng ' . $value->month);
                                            array_push($data, $value->tong);
                                        }
                                        
                                    @endphp
                                    <script>
                                        var labels = <?php echo json_encode($label); ?>;
                                        // var labels = [
                                        //     'January',
                                        //     'February',
                                        //     'March',
                                        //     'April',
                                        //     'May',
                                        //     'June',
                                        // ];



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
                                            options: {}
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
    <!-- ChartJS -->
    {{-- <script src="{{ asset('admin_assets/plugins/chart.js/Chart.min.js') }}"></script> --}}


    <!-- AdminLTE App -->
    <script src="{{ asset('admin_assets/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('admin_assets/dist/js/demo.js') }}"></script> --}}
@endsection
