<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Academix') }}</title>

    {{-- Google Fonts --}}
     <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            overflow-x: hidden !important;
        }

        h1, h2, h3, p, a, button {
            font-family: 'Cairo', sans-serif !important;
        }
        .bg-cart {
            background-color: #ffc107;
            color: #fff
        }
        .score {
            display: block;
            font-size: 16px;
            position: relative;
            overflow: hidden;
        }
        .score-wrap {
            display: inline-block;
            position: relative;
            height: 19px;
        }
        .score .stars-active {
            color: #FFCA00;
            position: relative;
            z-index: 10;
            display: block;
            overflow: hidden;
            white-space: nowrap;
        }
        .score .stars-inactive {
            color: lightgrey;
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
    @yield('style')

    
</head>
<body>

    {{-- Navigation Bar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">{{ __('Academix') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto gap-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/*') ? 'active' : '' }}" href="{{ route('home.index') }}">
                            {{ __('صفحة الرئيسية') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('courses*') ? 'active' : '' }}" href="{{ route('courses.showAll') }}">
                            {{ __('جميع الدورات') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('blogs*') ? 'active' : '' }}" href="{{ route('blogs.showAll') }}">
                            {{ __('جميع المقالات') }}
                        </a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('myCourses*') ? 'active' : '' }}" href="{{route('courses.myOrders')}}">
                            {{ __('دوراتي') }}
                        </a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('cart*') ? 'active' : '' }}" href="{{ route('cart.view') }}">
                                @if(Auth::user()->CoursesInCart()->count() > 0)
                                    <span class="badge bg-secondary cart-count">{{ Auth::user()->CoursesInCart()->count() }}</span>
                                @else
                                    <span class="badge bg-secondary cart-count" id="cart-count">0</span>
                                @endif
                                {{__('عربة التسوق')}} 
                                <i class="fas fa-shopping-cart"></i> 
                            </a>
                        </li>
                    @endAuth

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-bs-toggle="dropdown">
                            🌐 {{ app()->getLocale() === 'ar' ? 'العربية' : 'English' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown" style="text-align: start !important;">
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'ar') }}">العربية</a></li>
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a></li>
                        </ul>
                    </li>
                </ul>

                {{-- User Dropdown --}}
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <img class="rounded-circle mx-2" width="28" height="28" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="text-align: start !important;">
                            @if (Auth::user()->isAdmin())
                            <li><a class="dropdown-item" href="{{ route('admin.index') }}">{{ __('لوحة التحكم') }}</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">{{ __('ملف الشخصي') }}</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">{{ __('تسجيل الخروج') }}</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endauth

                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('تسجيل الدخول') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('تسجيل') }}</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}

    {{-- Page Content --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p>{{__('© 2025 أكاديمكس - جميع الحقوق محفوظة')}}</p>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    @yield('script')
</body>
</html>
