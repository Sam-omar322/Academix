<nav class="navbar navbar-expand-lg border-bottom shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand">{{ __('أكاديمكس') }}</span>
        <ul class="navbar-nav">
            <li class="nav-item dropdown mx-3 mt-1">
                <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-bs-toggle="dropdown">
                    🌐 {{ app()->getLocale() === 'ar' ? 'العربية' : 'English' }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown" style="text-align: start !important;">
                    <li><a class="dropdown-item" href="{{ route('lang.switch', 'ar') }}">العربية</a></li>
                    <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                    <img class="rounded-circle mx-2" width="28" height="28" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" style="text-align: start !important;">
                    @if (Auth::user()->isAdmin())
                        <li><a class="dropdown-item" href="{{ route('home.index') }}">{{ __('الذهاب إلى الموقع') }}</a></li>
                        <li><hr class="dropdown-divider"></li>
                    @endif
                    <li><a class="dropdown-item" href="{{ route('profile.show') }}">{{ __('الملف الشخصي') }}</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">{{ __('تسجيل الخروج') }}</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
