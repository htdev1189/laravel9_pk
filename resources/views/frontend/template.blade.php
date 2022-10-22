<!DOCTYPE html>
<html lang="en">

<head>
    @yield('top')
</head>

<body>
    <div id="website">
        {{-- header --}}
        @include('frontend.inc.header')
        {{-- content --}}
        @yield('content')
    </div>
    {{-- hktMenu --}}
    @include('frontend.inc.hktMenu')

</body>
@yield('script')

</html>
