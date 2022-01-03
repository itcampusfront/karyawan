<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts/_head')
    @yield('css')
    <title>@yield('title') | {{ config('app.name') }}</title>
</head>
<body>

    @include('layouts/_navbar')

    @if(Auth::user()->end_date == null)
    <div class="container mt-5">
        @yield('content')
    </div>
    @else
    <div class="container mt-5">
        <div class="alert alert-danger text-center" role="alert">
            Selamat datang <strong>{{ Auth::user()->name }}</strong> di {{ setting('name') }}. Mohon maaf untuk memberitahukan bahwa status Anda disini sudah <strong>Tidak Aktif</strong>.
        </div>
    </div>
    @endif

    @include('layouts/_js')
    @yield('js')

</body>
</html>