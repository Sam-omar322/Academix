<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    {{-- Google Fonts --}}
     <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            overflow-x: hidden !important;
        }

        h1, h2, h3, p, a, button {
            font-family: 'Cairo', sans-serif !important;
        }
        .sidebar { width: 220px; height: 100vh; position: fixed; top: 0; {{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: 0; background: #343a40; color: white; padding-top: 20px; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 10px 20px; }
        .sidebar a:hover { background: #495057; }
        .main-content { margin-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: 220px; padding: 20px; }
        .flash-message { margin-top: 10px; }
        .nav-link {background-color: #343a40; color: white; border: 1px solid #495057; border-radius: 5px; margin-bottom: 5px;}
        .nav-link.active {background-color: #495057;}
        .nav-link:focus, .nav-link:hover {color: white;}
    </style>
    @yield("style")
</head>
<body>
    @include('layouts.dashbaord.partials.header')
    @include('layouts.dashbaord.partials.sidebar')

    <div class="main-content">
        @if(session()->has('flash_message'))
            <div class="alert alert-success flash-message">
                {{ session('flash_message') }}
            </div>
        @endif

        @yield('content')
    </div>

    @include('layouts.dashbaord.partials.footer')

    @yield("script")
</body>
</html>
