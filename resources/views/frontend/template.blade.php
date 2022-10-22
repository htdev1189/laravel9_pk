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
    @include('frontend.inc.module1')

</body>
@yield('script')

</html>
