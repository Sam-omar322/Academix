<!-- Wrapper -->
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="text-center mb-4">
            <h4><i class="fas fa-book"></i> {{ __('أكاديمكس') }}</h4>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                    <i class="fas fa-chart-pie"></i><span class="menu-text"> {{ __('لوحة التحكم') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/courses/*') ? 'active' : '' }}" href="{{ route('courses.index') }}">
                    <i class="fas fa-video"></i><span class="menu-text"> {{ __('الدورات') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/blogs/*') ? 'active' : '' }}" href="{{ route('blogs.index') }}">
                    <i class="fas fa-blog"></i><span class="menu-text"> {{ __('المدونة') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/users/*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <i class="fas fa-user"></i><span class="menu-text"> {{ __('المستخدمون') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/allOrders/*') ? 'active' : '' }}" href="{{ route('admin.allorders') }}">
                    <i class="fas fa-user"></i><span class="menu-text"> {{ __('الطلبات') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
