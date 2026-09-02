<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dutch-Bangla Bank PLC.</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/webp" href="{{ asset('assets/img/logo.webp') }}">
    <link rel="shortcut icon" type="image/webp" href="{{ asset('assets/img/logo.webp') }}">
    
    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Header Navbar */
        .top-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.85rem 1rem;
            width: 100%;
        }

        .header-container {
            max-width: 1140px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .bank-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .bank-name {
            font-weight: 700;
            font-size: 1.15rem;
            color: #0f172a;
            letter-spacing: -0.2px;
        }

        .page-badge-container {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #334155;
            font-size: 0.92rem;
            font-weight: 500;
        }

        @media (max-width: 576px) {
            .header-container {
                justify-content: flex-start;
                gap: 10px;
            }
            .page-badge-container {
                font-size: 0.85rem;
            }
        }

        .page-badge-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background-color: #e0e7ff;
            color: #4338ca;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        /* Content Area */
        .main-content {
            flex: 1 0 auto;
            max-width: 1140px;
            width: 100%;
            margin: 0 auto;
            padding: 2.25rem 1rem;
        }

        .verification-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: #ecfdf5;
            color: #059669;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 50rem;
            letter-spacing: 0.5px;
            border: 1px solid #d1fae5;
            margin-bottom: 0.4rem;
        }

        .tag-dot {
            width: 5px;
            height: 5px;
            background-color: #059669;
            border-radius: 50%;
            display: inline-block;
        }

        .verification-desc {
            color: #64748b;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }

        /* Detail Box Cards */
        .detail-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.95rem 1.25rem 0.95rem 1.35rem;
            position: relative;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: default;
            overflow: hidden;
        }

        .detail-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 8px;
            bottom: 8px;
            width: 4px;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
            transition: all 0.25s ease;
        }

        /* Accent Colors & Hover Effects */
        .accent-blue::before { background-color: #2563eb; }
        .accent-blue .card-title-text { color: #2563eb; }
        .accent-blue:hover {
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.14), 0 2px 6px rgba(0, 0, 0, 0.04);
            border-color: #93c5fd;
            background: linear-gradient(90deg, #eff6ff 0%, #ffffff 45%);
            transform: translateY(-2px);
        }
        .accent-blue:hover::before {
            width: 6px;
            background-color: #1d4ed8;
            box-shadow: 0 0 10px rgba(37, 99, 235, 0.5);
        }

        .accent-red::before { background-color: #dc2626; }
        .accent-red .card-title-text { color: #dc2626; }
        .accent-red:hover {
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.14), 0 2px 6px rgba(0, 0, 0, 0.04);
            border-color: #fca5a5;
            background: linear-gradient(90deg, #fef2f2 0%, #ffffff 45%);
            transform: translateY(-2px);
        }
        .accent-red:hover::before {
            width: 6px;
            background-color: #b91c1c;
            box-shadow: 0 0 10px rgba(220, 38, 38, 0.5);
        }

        .accent-green::before { background-color: #059669; }
        .accent-green .card-title-text { color: #059669; }
        .accent-green:hover {
            box-shadow: 0 6px 20px rgba(5, 150, 105, 0.14), 0 2px 6px rgba(0, 0, 0, 0.04);
            border-color: #a7f3d0;
            background: linear-gradient(90deg, #ecfdf5 0%, #ffffff 45%);
            transform: translateY(-2px);
        }
        .accent-green:hover::before {
            width: 6px;
            background-color: #047857;
            box-shadow: 0 0 10px rgba(5, 150, 105, 0.5);
        }

        .card-title-text {
            font-size: 0.82rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
            display: block;
        }

        .card-value-text {
            font-size: 1rem;
            font-weight: 600;
            color: #0f172a;
        }

        /* Footer */
        footer {
            margin-top: auto;
            width: 100%;
        }

        .footer-text {
            text-align: center;
            padding: 1rem;
            color: #64748b;
            font-size: 0.78rem;
            background-color: transparent;
        }

        .footer-strip {
            height: 3px;
            width: 100%;
            background: linear-gradient(to right, #008080 0%, #008080 33.33%, #dc2626 33.33%, #dc2626 66.66%, #1e40af 66.66%, #1e40af 100%);
        }
    </style>
</head>
<body>

    <!-- Header Navbar -->
    <header class="top-navbar">
        <div class="header-container">
            
            <!-- Left: Bank Brand -->
            <div class="bank-brand">
                <img src="{{ asset('assets/img/logo.webp') }}" alt="Dutch-Bangla Bank" height="34" class="me-1" style="object-fit: contain;">
                <span class="bank-name d-none d-sm-inline">Dutch-Bangla Bank PLC.</span>
            </div>

            <!-- Right: Verification Title Badge -->
            <div class="d-flex align-items-center">
                <div class="vr mx-3 d-none d-sm-block text-secondary opacity-25" style="height: 28px;"></div>
                <div class="page-badge-container">
                    <div class="page-badge-icon d-none d-sm-flex">
                        <i class="bi bi-card-checklist"></i>
                    </div>
                    <span>Account Statement Verification</span>
                </div>
            </div>

        </div>
    </header>

    <!-- Main Verification Body -->
    <main class="main-content">
        
        <!-- Verification Details Tag -->
        <div class="verification-tag">
            <span class="tag-dot"></span>
            VERIFICATION DETAILS
        </div>
        
        <p class="verification-desc">The following information was retrieved from the scanned QR Code and verified.</p>

        <!-- 2-Column Grid -->
        <div class="row g-3">
            
            <!-- 1. Account No (Blue) -->
            <div class="col-md-6">
                <div class="detail-card accent-blue" title="{{ $statement->account_no }}">
                    <span class="card-title-text">Account No</span>
                    <div class="card-value-text">{{ $statement->account_no }}</div>
                </div>
            </div>

            <!-- 2. Account Name (Red) -->
            <div class="col-md-6">
                <div class="detail-card accent-red" title="{{ $statement->account_name }}">
                    <span class="card-title-text">Account Name</span>
                    <div class="card-value-text">{{ $statement->account_name }}</div>
                </div>
            </div>

            <!-- 3. Opening Balance (Green) -->
            <div class="col-md-6">
                <div class="detail-card accent-green" title="{{ $statement->formatted_opening_balance }}">
                    <span class="card-title-text">Opening Balance</span>
                    <div class="card-value-text">{{ $statement->formatted_opening_balance }}</div>
                </div>
            </div>

            <!-- 4. Closing Balance (Blue) -->
            <div class="col-md-6">
                <div class="detail-card accent-blue" title="{{ $statement->formatted_closing_balance }}">
                    <span class="card-title-text">Closing Balance</span>
                    <div class="card-value-text">{{ $statement->formatted_closing_balance }}</div>
                </div>
            </div>

            <!-- 5. Report Generation Date (Red) -->
            <div class="col-md-6">
                <div class="detail-card accent-red" title="{{ $statement->formatted_generation_date }}">
                    <span class="card-title-text">Report Generation Date</span>
                    <div class="card-value-text">{{ $statement->formatted_generation_date }}</div>
                </div>
            </div>

        </div>

    </main>

    <!-- Bottom Strip & Footer -->
    <footer>
        <div class="footer-strip"></div>
        <div class="footer-text">
            Copyright @ {{ date('Y') }}. Dutch-Bangla Bank
        </div>
    </footer>

</body>
</html>
