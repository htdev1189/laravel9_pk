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
                    <div class="hkt-style-4">{{ $category->name }}</div>
                    <p>{!! $category->description !!}</p>
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
                    @if ($posts->count() == 0)
                        <div class="alert alert-danger" role="alert">
                            Bài viết đang được cập nhật ...
                        </div>
                    @else
                        <div class="category-list">
                            @foreach ($posts as $post)
                                <div class="category-item mb-5">
                                    <div class="row flex-sm-row-reverse">
                                        <div class="col-sm-10">
                                            <div class="card">
                                                <div class="hkt-card-img">
                                                    <img src="{{ $post->image }}">
                                                    {{-- car abs --}}
                                                    <div class="category-img-abs d-flex d-sm-none">
                                                        <img src="{{ asset('frontend_assets/image/tacgia.jpeg') }}">
                                                        <p>
                                                            <span><i class="fa fa-clock-o"
                                                                    aria-hidden="true"></i>{{ date('F j, Y', strtotime($post->created_at)) }}</span>
                                                            <br>
                                                            <span><i class="fa fa-user-circle-o" aria-hidden="true"></i> by
                                                                Chase Franklin</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="category-item-info mt-3 mb-3">
                                                        <span class="text-capitalize"><i class="fa fa-tags"
                                                                aria-hidden="true"></i> {{ $category->name }}</span>
                                                    </div>
                                                    <h5 class="card-title"><a
                                                            href="{{ URL::to($post->slug . '.html') }}">{{ $post->title }}</a>
                                                    </h5>
                                                    <p class="card-text">
                                                        {!! $post->description !!}
                                                    </p>
                                                    <a href="{{ URL::to($post->slug . '.html') }}" class="btn-hkt">Read
                                                        more</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-none d-sm-block col-sm-2 hkt-card-img2">
                                            <img class="rounded-circle"
                                                src="{{ asset('frontend_assets/image/tacgia.jpeg') }}">
                                            <p class="mb-0 text-center">
                                                <span><i class="fa fa-user-circle-o" aria-hidden="true"></i> by
                                                    Chase Franklin</span><br>
                                                <span><i class="fa fa-clock-o" aria-hidden="true"></i>
                                                    {{ date('F j, Y', strtotime($post->created_at)) }}</span>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
                {{-- ben phai --}}
                <div class="col-md-3">
                    <div class="category-recent-post">
                        <div class="hkt-style-1">recent posts</div>
                        @foreach ($recent_posts as $recent)
                            <div class="category-recent-post-item">
                                <a href="{{ URL::to($recent->slug . '.html') }}">
                                    <img src="{{ $recent->image }}">
                                </a>
                                <div>
                                    <span>{{ date('F j, Y', strtotime($recent->created_at)) }}</span>
                                    <a href="{{ URL::to($recent->slug . '.html') }}">{{ $recent->title }}</a>
                                </div>
                            </div>
                        @endforeach
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
