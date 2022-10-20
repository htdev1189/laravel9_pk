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
    <!-- banner -->
    @include('frontend.inc.banner')

    <!-- gioi thieu -->
    @include('frontend.inc.gioithieu')

    <!-- passion -->
    @include('frontend.inc.sumenh')

    {{-- team --}}
    @include('frontend.inc.team')

    {{-- lien he --}}
    @include('frontend.inc.lienhe')

    {{-- bai viet --}}
    @include('frontend.inc.baiviet')

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
