<aside class="app-sidebar bg-body shadow" data-bs-theme="dark">
    <!-- Sidebar Brand -->
    <div class="app-brand d-flex align-items-center justify-content-between px-3 py-3 border-bottom border-secondary border-opacity-25">
        <a href="{{ route('admin.dashboard') }}" class="brand-link text-decoration-none d-flex align-items-center gap-2">
            <div class="brand-icon-box">
                <i class="bi bi-qr-code"></i>
            </div>
            <div class="d-flex flex-column">
                <span class="brand-text text-white">Insaf<span class="ms-1" style="color: #818cf8;">Verification</span></span>
                <span class="text-white-50" style="font-size: 0.7rem; letter-spacing: 0.5px;">QR GENERATOR</span>
            </div>
        </a>
    </div>

    <!-- Sidebar Wrapper -->
    <div class="sidebar-wrapper">
        <nav class="mt-3 px-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                
                <!-- Dashboard -->
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') || request()->routeIs('home') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-grid-1x2-fill text-info"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header text-uppercase text-white-50 small fw-bold px-3 mb-2">QR Management</li>
                
                <!-- Unified Verifications (Certificate + Statement) -->
                <li class="nav-item">
                    <a href="{{ route('admin.verifications.index') }}" class="nav-link {{ request()->routeIs('admin.verifications.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-qr-code-scan text-primary"></i>
                        <p>Verifications</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
