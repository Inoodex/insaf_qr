<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>

    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- AdminLTE 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/css/adminlte.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .brand-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
            margin: 0 auto 12px;
        }

        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #4338ca 0%, #4f46e5 100%);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<div class="login-card">
    
    <!-- Top Branding -->
    <div class="p-4 pt-5 text-center border-bottom bg-light bg-gradient">
        <div class="brand-icon-box">
            <i class="bi bi-qr-code"></i>
        </div>
        <h4 class="fw-bold mb-1 text-dark">QR Code <span class="text-primary">Verification</span></h4>
        <!-- <p class="text-muted small mb-0">Bank Verification System Login</p> -->
    </div>

    <!-- Login Form Body -->
    <div class="p-4">
        
        @if(session('status'))
            <div class="alert alert-info py-2 small d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-info-circle-fill"></i>
                <div>{{ session('status') }}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger py-2 small mb-3">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email Input -->
            <div class="mb-3">
                <label class="form-label fw-semibold small text-muted text-uppercase">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>
            </div>

            <!-- Password Input -->
            <div class="mb-3">
                <label class="form-label fw-semibold small text-muted text-uppercase">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" checked>
                    <label class="form-check-label small text-muted" for="rememberMe">Remember me</label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary rounded-3">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Sign In to Dashboard
                </button>
            </div>
        </form>

    </div>

    <!-- Footer -->
    <div class="p-3 bg-light text-center border-top text-muted small">
        &copy; {{ date('Y') }} | All rights reserved.
    </div>

</div>

<!-- Bootstrap 5.3 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
