@extends('frontend.template')

@section('top')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css') }}">
@endsection

@section('content')
    {{-- banner categore --}}
    <div id="category-banner" class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="hkt-style-4">blog</div>
                    <p>Credibly reintermediate backend ideas for cross-platform models. Continually reintermediate
                        integrated
                        processes through technically sound intellectual capital.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- hien thi danh sach bai viet --}}
    <div id="category-main" class="pt-5 pb-5">
        <div class="container-xl">
            <div class="row">
                {{-- ben trai --}}
                <div class="col-md-9">
                    {{-- breadcrumb --}}
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Library</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data</li>
                        </ol>
                    </nav>

                    <div id="post-main">
                        <h1>{{ $post->title }}</h1>
                        <div class="baiviet-top pt-2 pb-2 border-bottom mb-3">
                            <span><i class="fa fa-clock-o" aria-hidden="true"></i> February 5, 2018</span> /
                            <span><i class="fa fa-user-circle-o" aria-hidden="true"></i> by Chase Franklin</span>
                        </div>
                        <div id="post-content">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>
                {{-- ben phai --}}
                <div class="col-md-3">
                    <div class="category-recent-post">
                        <div class="hkt-style-1">recent posts</div>
                        @for ($i = 0; $i < 5; $i++)
                            <div class="category-recent-post-item">
                                <a href="">
                                    <img src="{{ asset('frontend_assets/image/shutterstock_157746134-160x160.jpg') }}">
                                </a>
                                <div>
                                    <span>OCTOBER 18, 2015</span>
                                    <a href="">2015 Best USA Hospitals and Clinics</a>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- gui so dien thoai --}}
    @include('frontend.inc.guisdt')

    {{-- footer --}}
    @include('frontend.inc.footer')
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
@endsection
