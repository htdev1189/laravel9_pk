<!DOCTYPE html>
<html lang="en">

<head>
    @yield('top')
</head>

<body>
    {{-- header --}}
    @include('frontend.inc.header')
    {{-- content --}}
    @yield('content')

</body>
@yield('script')
</html>
