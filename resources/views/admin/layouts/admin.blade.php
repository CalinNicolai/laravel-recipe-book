<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Recipe Book')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<!-- Navbar -->
@include('admin.components.navbar')

<!-- Main Content -->
<div class="w-full p-5:">
    @yield('content')
</div>

<!-- Footer -->
@include('admin.components.footer')
</body>
</html>
