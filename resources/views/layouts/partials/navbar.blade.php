<nav class="app-header navbar navbar-expand bg-body shadow-sm">
    <div class="container-fluid">
        <!-- Start Navbar Links -->
        <ul class="navbar-nav align-items-center">
            <li class="nav-item">
                <a class="nav-link px-2" data-lte-toggle="sidebar" href="#" role="button" title="Toggle Sidebar">
                    <i class="bi bi-list fs-4"></i>
                </a>
            </li>
        </ul>
        <!-- End Navbar Links -->

        <!-- Right Navbar Links -->
        <ul class="navbar-nav ms-auto align-items-center">
            <!-- Dark / Light Mode Toggle -->
            <li class="nav-item me-3">
                <button class="nav-link btn btn-link p-2" id="themeToggleBtn" title="Toggle Dark/Light Mode">
                    <i id="themeToggleIcon" class="bi bi-moon-stars-fill text-secondary fs-5"></i>
                </button>
            </li>

            <!-- User Profile Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 px-3 py-1 bg-body-secondary rounded-pill border text-decoration-none shadow-xs" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=4f46e5&color=fff&rounded=true" class="rounded-circle shadow-xs" alt="User" width="24" height="24">
                    <span class="small fw-bold d-none d-sm-inline">{{ Auth::user()->name ?? 'Bank Admin' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2 p-2" style="min-width: 230px; border-radius: 12px;">
                    <!-- User Header Details -->
                    <li class="px-3 py-2 border-bottom mb-2 bg-body-tertiary rounded-3">
                        <div class="fw-bold text-truncate">{{ Auth::user()->name ?? 'Bank Admin' }}</div>
                        <div class="small text-muted text-truncate">{{ Auth::user()->email ?? 'admin@example.com' }}</div>
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle mt-1" style="font-size: 0.7rem;">Administrator</span>
                    </li>
                    
                    <!-- Sign Out Action -->
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center gap-2 text-danger rounded-2 py-2 fw-medium">
                                <i class="bi bi-box-arrow-right fs-6"></i>
                                <span>Sign Out</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- End Right Navbar Links -->
    </div>
</nav>
