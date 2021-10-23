<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.includes.head')

<body class="antialiased">
    <!-- Header -->
    @include('layouts.includes.header')
    @if (session()->has('error'))
        <div class="alert alert-success">
            {{ session()->get('error') }}
        </div>

    @endif
    @yield('content')

    {{-- @include('sweetalert::alert') --}}
    <!-- Footer -->
    @include('layouts.includes.footer')
</body>

</html>
