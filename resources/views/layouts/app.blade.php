<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.includes.head')

<body class="antialiased">
    <!-- Header -->
    @include('layouts.includes.header')

    @yield('content')

    <!-- Footer -->
    @include('layouts.includes.footer')
</body>

</html>
