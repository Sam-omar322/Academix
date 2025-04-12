<!-- Wrapper -->
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="text-center mb-4">
        <h4><i class="fas fa-book"></i> Academix</h4>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <!-- <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ route('admin.index') }}"> -->
                <a class="nav-link">
                    <i class="fas fa-chart-pie"></i><span class="menu-text"> Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link">
                    <i class="fas fa-video"></i><span class="menu-text"> Courses</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link">
                    <i class="fas fa-blog"></i><span class="menu-text"> Blogs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link">
                    <i class="fas fa-user"></i><span class="menu-text"> Students</span>
                </a>
            </li>
        </ul>
    </div>
</div>
