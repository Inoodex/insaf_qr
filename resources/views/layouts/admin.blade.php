<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') | Insaf QR Code</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">   

    <!-- Prevent Theme Flash (FOUC) -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
        })();
    </script>   

    <!-- Google Font: Inter & Source Sans 3 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Source+Sans+3:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css">
    <!-- AdminLTE 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/css/adminlte.min.css">

    <!-- ApexCharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.49.0/dist/apexcharts.css">

    <!-- Custom Theme & Aesthetic Styling -->
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            --accent-glow: rgba(79, 70, 229, 0.15);
            --card-radius: 0.85rem;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', 'Source Sans 3', sans-serif;
            background-color: #f4f6f9;
            color: #1e293b;
            transition: background-color 0.25s ease, color 0.25s ease;
        }

        .app-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .app-main {
            flex: 1 0 auto;
        }

        .app-footer {
            margin-top: auto;
            background-color: var(--bs-body-bg);
            border-top: 1px solid var(--bs-border-color);
            transition: background-color 0.25s ease, border-color 0.25s ease;
        }

        @media (min-width: 992px) {
            .app-sidebar {
                position: fixed !important;
                top: 0;
                bottom: 0;
                left: 0;
                width: 250px;
                height: 100vh;
                z-index: 1030;
            }
            .app-header,
            .app-main,
            .app-footer {
                margin-left: 250px;
            }
            body.sidebar-collapse .app-sidebar {
                margin-left: -250px !important;
            }
            body.sidebar-collapse .app-header,
            body.sidebar-collapse .app-main,
            body.sidebar-collapse .app-footer {
                margin-left: 0 !important;
            }
        }

        .app-sidebar,
        .app-header,
        .app-main,
        .app-footer {
            transition: margin-left 0.25s ease, background-color 0.25s ease, border-color 0.25s ease;
        }

        /* Modern card styling */
        .card {
            border-radius: var(--card-radius);
            border: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
            background-color: #ffffff;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.25s ease, border-color 0.25s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            width: 100%;
        }

        .card-header .card-tools,
        .card-header .ms-auto {
            margin-left: auto !important;
        }

        /* Brand & Sidebar styling */
        .app-sidebar {
            box-shadow: 0 0 25px rgba(0,0,0,0.05);
        }
        .app-brand {
            padding: 1rem 1.25rem;
            background: linear-gradient(180deg, rgba(255,255,255,0.05) 0%, transparent 100%);
        }
        .brand-icon-box {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.4);
        }
        .brand-text {
            font-weight: 700;
            font-size: 1.15rem;
            letter-spacing: -0.3px;
        }

        /* Nav links */
        .nav-link.active {
            background: var(--primary-gradient) !important;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35) !important;
            border-radius: 8px !important;
        }
        .nav-link {
            border-radius: 8px;
            margin-bottom: 2px;
            font-weight: 500;
        }

        /* Remove any click/focus effect on search fields */
        #searchCertInput:focus,
        #searchStmtInput:focus,
        .card-tools .form-control:focus,
        .card-tools .input-group .form-control:focus {
            box-shadow: none !important;
            outline: none !important;
            border-color: var(--bs-border-color) !important;
        }

        /* Ensure table dropdown menus always float above table and cards */
        .table-responsive {
            overflow: visible !important;
            min-height: 250px;
        }
        .card:has(.table-responsive) {
            overflow: visible !important;
        }
        .table td .dropdown-menu {
            z-index: 9999 !important;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.18) !important;
        }
        
        /* QR Canvas preview container */
        .qr-preview-box {
            background: #ffffff;
            border: 2px dashed #cbd5e1;
            border-radius: 14px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 270px;
            position: relative;
            transition: background-color 0.25s ease, border-color 0.25s ease;
        }

        .qr-canvas-holder {
            background: #ffffff;
            border-radius: 12px;
            padding: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
        }

        /* =========================================================
           ENHANCED DARK MODE DESIGN SYSTEM
           ========================================================= */
        [data-bs-theme="dark"] {
            --bs-body-bg: #0b0f19;
            --bs-body-color: #f1f5f9;
            --bs-body-color-rgb: 241, 245, 249;
            --bs-secondary-color: #94a3b8;
            --bs-tertiary-color: #64748b;
            --bs-body-secondary-bg: #162032;
            --bs-body-tertiary-bg: #0f172a;
            --bs-border-color: rgba(255, 255, 255, 0.09);
            --bs-border-color-translucent: rgba(255, 255, 255, 0.08);
            --bs-link-color: #818cf8;
            --bs-link-hover-color: #a5b4fc;
        }

        [data-bs-theme="dark"] body {
            background-color: #0b0f19;
            color: #f1f5f9;
        }

        [data-bs-theme="dark"] .app-header {
            background-color: #111827 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        }

        [data-bs-theme="dark"] .app-sidebar {
            background-color: #0f172a !important;
            border-right: 1px solid rgba(255, 255, 255, 0.06);
        }

        [data-bs-theme="dark"] .card {
            background-color: #111827;
            border-color: rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
        }

        [data-bs-theme="dark"] .card-header {
            border-bottom-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* Form Inputs in Dark Mode */
        [data-bs-theme="dark"] .form-control {
            background-color: #162032;
            border-color: #334155;
            color: #f8fafc;
        }

        [data-bs-theme="dark"] .form-control:focus {
            background-color: #162032;
            border-color: #6366f1;
            color: #ffffff;
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
        }

        [data-bs-theme="dark"] .input-group-text {
            background-color: #1e293b;
            border-color: #334155;
            color: #94a3b8;
        }

        /* QR Preview & Payload Box in Dark Mode */
        [data-bs-theme="dark"] .qr-preview-box {
            background-color: #162032;
            border-color: #334155;
        }

        [data-bs-theme="dark"] .qr-canvas-holder {
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        }

        [data-bs-theme="dark"] #payloadContainer,
        [data-bs-theme="dark"] #stmtPayloadContainer {
            background-color: #162032 !important;
            border-color: #334155 !important;
        }

        [data-bs-theme="dark"] #displayRawPayload,
        [data-bs-theme="dark"] #displayStmtRawPayload {
            color: #e2e8f0 !important;
        }

        /* Tables in Dark Mode */
        [data-bs-theme="dark"] .table {
            --bs-table-bg: transparent;
            --bs-table-color: #cbd5e1;
            --bs-table-border-color: rgba(255, 255, 255, 0.08);
            --bs-table-hover-bg: rgba(255, 255, 255, 0.04);
            color: #cbd5e1;
        }

        [data-bs-theme="dark"] thead th {
            background-color: #162032 !important;
            color: #94a3b8 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        [data-bs-theme="dark"] tr.table-primary td {
            background-color: rgba(79, 70, 229, 0.2) !important;
            color: #e0e7ff !important;
        }

        [data-bs-theme="dark"] tr.table-success td {
            background-color: rgba(16, 185, 129, 0.2) !important;
            color: #d1fae5 !important;
        }

        /* Dropdowns & Breadcrumbs in Dark Mode */
        [data-bs-theme="dark"] .dropdown-menu {
            background-color: #162032;
            border: 1px solid #334155;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.45);
        }

        [data-bs-theme="dark"] .dropdown-item:hover,
        [data-bs-theme="dark"] .dropdown-item:focus {
            background-color: rgba(255, 255, 255, 0.06);
        }

        [data-bs-theme="dark"] .app-footer {
            background-color: #0b0f19 !important;
            border-top-color: rgba(255, 255, 255, 0.08) !important;
        }

        [data-bs-theme="dark"] .breadcrumb-item a {
            color: #818cf8;
        }

        [data-bs-theme="dark"] .breadcrumb-item.active {
            color: #94a3b8;
        }
    </style>

    @stack('styles')
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        
        <!-- Header Navbar -->
        @include('layouts.partials.navbar')

        <!-- Main Sidebar Container -->
        @include('layouts.partials.sidebar')

        <!-- Content Wrapper -->
        <main class="app-main">
            <!-- App Content Header -->
            <div class="app-content-header py-3">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h3 class="mb-0 fw-bold">@yield('page_title', 'Dashboard')</h3>
                            <small class="text-muted">@yield('page_subtitle', 'Overview of your QR campaigns and metrics')</small>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end mb-0 bg-transparent p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door-fill me-1"></i>Home</a></li>
                                @yield('breadcrumb')
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- App Content Body -->
            <div class="app-content">
                <div class="container-fluid">
                    <!-- Global Error Alerts -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 d-flex align-items-start gap-2 mb-4" role="alert">
                            <i class="bi bi-exclamation-triangle-fill fs-5 mt-1 flex-shrink-0"></i>
                            <div class="flex-grow-1">
                                <strong class="d-block mb-1">Please correct the following error(s):</strong>
                                <ul class="mb-0 ps-3 small">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 d-flex align-items-center gap-2 mb-4" role="alert">
                            <i class="bi bi-exclamation-triangle-fill fs-5 flex-shrink-0"></i>
                            <div class="flex-grow-1 fw-semibold">
                                {{ session('error') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Footer -->
        @include('layouts.partials.footer')

    </div>

    <!-- Floating Toast Notification Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div id="appToast" class="toast align-items-center border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4000">
            <div class="d-flex align-items-center">
                <div class="toast-body d-flex align-items-center gap-2 py-3 px-3">
                    <i id="appToastIcon" class="bi bi-check-circle-fill fs-5"></i>
                    <div id="appToastMsg" class="fw-semibold"></div>
                </div>
                <button type="button" class="btn-close me-3 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Scripts: Popper, Bootstrap, OverlayScrollbars, AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/js/adminlte.min.js"></script>
    
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.49.0/dist/apexcharts.min.js"></script>

    <!-- QR Code Styling & QRCode.js (High Reliability CDNs) -->
    <script src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script>
        // Global Toast Notification Helper
        window.showToast = function(message, type = 'success') {
            const toastEl = document.getElementById('appToast');
            if (!toastEl) return;

            const toastIcon = document.getElementById('appToastIcon');
            const toastMsg = document.getElementById('appToastMsg');
            const closeBtn = toastEl.querySelector('.btn-close');

            // Reset classes
            toastEl.className = 'toast align-items-center border-0 shadow-lg';
            closeBtn.className = 'btn-close me-3 m-auto';

            let iconClass = 'bi bi-check-circle-fill fs-5';
            let bgClass = 'bg-success text-white';

            if (type === 'success') {
                bgClass = 'bg-success text-white';
                iconClass = 'bi bi-check-circle-fill fs-5';
                closeBtn.classList.add('btn-close-white');
            } else if (type === 'danger' || type === 'error') {
                bgClass = 'bg-danger text-white';
                iconClass = 'bi bi-exclamation-triangle-fill fs-5';
                closeBtn.classList.add('btn-close-white');
            } else if (type === 'warning') {
                bgClass = 'bg-warning text-dark';
                iconClass = 'bi bi-exclamation-circle-fill fs-5';
            } else if (type === 'info') {
                bgClass = 'bg-primary text-white';
                iconClass = 'bi bi-info-circle-fill fs-5';
                closeBtn.classList.add('btn-close-white');
            }

            toastEl.classList.add(...bgClass.split(' '));
            toastIcon.className = iconClass;
            toastMsg.textContent = message;

            const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
            toast.show();
        };

        // Auto-fire session notifications
        @if($errors->any())
            document.addEventListener('DOMContentLoaded', () => showToast(@json($errors->first()), 'danger'));
        @endif
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', () => showToast(@json(session('success')), 'success'));
        @endif
        @if(session('error'))
            document.addEventListener('DOMContentLoaded', () => showToast(@json(session('error')), 'danger'));
        @endif
        @if(session('info'))
            document.addEventListener('DOMContentLoaded', () => showToast(@json(session('info')), 'info'));
        @endif
        @if(session('warning'))
            document.addEventListener('DOMContentLoaded', () => showToast(@json(session('warning')), 'warning'));
        @endif

        // Dark Mode Toggle Logic
        const themeToggleBtn = document.getElementById('themeToggleBtn');
        const currentTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', currentTheme);
        updateThemeIcon(currentTheme);

        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', () => {
                const activeTheme = document.documentElement.getAttribute('data-bs-theme');
                const newTheme = activeTheme === 'dark' ? 'light' : 'dark';
                document.documentElement.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateThemeIcon(newTheme);
            });
        }

        function updateThemeIcon(theme) {
            const icon = document.getElementById('themeToggleIcon');
            if (icon) {
                if (theme === 'dark') {
                    icon.className = 'bi bi-sun-fill text-warning';
                } else {
                    icon.className = 'bi bi-moon-stars-fill text-secondary';
                }
            }
        }
    </script>

    @stack('scripts')
</body>
</html>
