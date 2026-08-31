<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title', config('app.name', 'E-Learning Kampus'))
    </title>
    <meta name="description" content="E-Learning Kampus">
    <meta name="author" content="E-Learning Kampus">
    <link rel="icon" type="image/png" href="{{ asset('template') }}/assets/images/favicon.ico">
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('template') }}/assets/libs/bootstrap/css/bootstrap.min.css">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="{{ asset('template') }}/assets/libs/bootstrap-icons/bootstrap-icons.css">
    {{-- ApexCharts --}}
    <link rel="stylesheet" href="{{ asset('template') }}/assets/libs/apexcharts/apexcharts.css">
    {{-- Flatpickr --}}
    <link rel="stylesheet" href="{{ asset('template') }}/assets/libs/flatpickr/flatpickr.min.css">
    {{-- Spark Admin --}}
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/main.css">
    @stack('styles')
</head>

<body>
    {{-- Sidebar --}}
    <x-sidebar />

    {{-- MAIN WRAPPER --}}
    <div class="main-wrapper">

        {{-- NAVBAR --}}
        <x-navbar />

        {{-- PAGE CONTENT --}}
        <main>
            @yield('content')
        </main>

        {{-- FOOTER --}}
        <x-footer />
    </div>

    {{-- JAVASCRIPT --}}
    <script src="{{ asset('template') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template') }}/assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('template') }}/assets/libs/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('template') }}/assets/js/dashboard.js"></script>
    @stack('scripts')
</body>

</html>
