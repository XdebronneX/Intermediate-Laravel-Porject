<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Tailwind CSS (latest) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Bootstrap 5 (latest) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (latest) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-9aITXQz3QIzM9fMMwV4eV1fYHLmZs3y2fMZyo3b+hNjkAOEBwJydjET1aYpCkZ0I" crossorigin="anonymous"/>

    <!-- DataTables (latest) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.0/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.0/css/dataTables.bootstrap5.min.css">

    <!-- Chart.js (latest) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    @include('partials.design')
    <div class="container">
        @yield('content')
    </div>
    @include('layouts.flash-messages')
    <!-- jQuery (latest version) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 5 JavaScript (latest) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables (latest) -->
    <script src="https://cdn.datatables.net/1.13.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.0/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- DataTables Buttons (latest) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.2.3/js/dataTables.buttons.min.js" integrity="sha512-QT3oEXamRhx0x+SRDcgisygyWze0UicgNLFM9Dj5QfJuu2TVyw7xRQfmB0g7Z5/TgCdYKNW15QumLBGWoPefYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Custom Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('scripts')
    @yield('body')

    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    @stack('scripts')

</body>
</html>
