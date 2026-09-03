<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Dutch-Bangla Bank PLC.</title>
    <link rel="icon" type="image/webp" href="{{ asset('assets/img/logo.webp') }}">
    <link rel="shortcut icon" type="image/webp" href="{{ asset('assets/img/logo.webp') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            border-width: 0;
        }

        body {
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(to bottom right, #f8fafc, #ffffff, #f1f5f9);
        }

        /* Animations */
        @keyframes qrFadeUp {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes qrHeaderWash {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes qrFooterBarShift {
            0% { background-position: 0% 50%; }
            100% { background-position: 200% 50%; }
        }

        .qr-animate-in {
            animation: qrFadeUp 0.45s ease-out both;
        }

        /* Header */
        .qr-header {
            position: sticky;
            top: 0;
            z-index: 40;
            border-bottom: 1px solid rgba(226, 232, 240, 0.7);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            backdrop-filter: blur(4px);
            background: linear-gradient(115deg, rgba(0,85,165,0.10) 0%, rgba(255,255,255,0.92) 28%, rgba(227,28,35,0.08) 50%, rgba(255,255,255,0.94) 72%, rgba(0,150,57,0.10) 100%);
            background-size: 220% 220%;
            animation: qrHeaderWash 12s ease-in-out infinite;
        }

        .header-wrap {
            max-width: 67rem;
            width: 100%;
            margin: 0 auto;
            padding: 0.625rem 0.75rem;
        }
        @media (min-width: 640px) {
            .header-wrap { padding: 0.625rem 1.25rem; }
        }
        @media (min-width: 1024px) {
            .header-wrap { padding: 0.625rem 2rem; }
        }

        /* Mobile Header */
        .header-mobile {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            min-width: 0;
        }
        @media (min-width: 1024px) {
            .header-mobile { display: none; }
        }
        .header-mobile img {
            height: 2rem;
            width: auto;
            object-fit: contain;
            flex-shrink: 0;
        }
        .header-mobile h1 {
            min-width: 0;
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            line-height: 1.375;
        }

        /* Desktop Header */
        .header-desktop {
            display: none;
        }
        @media (min-width: 1024px) {
            .header-desktop {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
            }
        }
        .header-left {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            min-width: 0;
        }
        .header-left img {
            height: 2rem;
            width: auto;
            object-fit: contain;
            flex-shrink: 0;
        }
        .header-left p {
            font-size: 0.875rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.25;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .header-right {
            text-align: right;
            min-width: 0;
            padding-left: 1rem;
            border-left: 1px solid rgba(148, 163, 184, 0.4);
        }
        .header-right-inner {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            justify-content: flex-end;
        }
        .header-icon {
            display: inline-flex;
            height: 2.25rem;
            width: 2.25rem;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            flex-shrink: 0;
            background-color: rgba(0, 85, 165, 0.094);
            color: #0055A5;
        }
        .header-icon svg {
            height: 1.25rem;
            width: 1.25rem;
        }
        .header-right h1 {
            font-size: 0.9375rem;
            font-weight: 600;
            color: #1e293b;
            line-height: 1.375;
        }

        /* Main Content */
        .main-content {
            flex: 1 0 auto;
        }
        .main-inner {
            max-width: 67rem;
            width: 100%;
            margin: 0 auto;
            padding: 1rem 0.75rem;
        }
        @media (min-width: 640px) {
            .main-inner { padding: 1.5rem 1.25rem; }
        }
        @media (min-width: 1024px) {
            .main-inner { padding: 1.5rem 2rem; }
        }

        /* Verification Tag */
        .tag-wrapper {
            text-align: center;
            margin-bottom: 0.75rem;
        }
        @media (min-width: 640px) {
            .tag-wrapper { text-align: left; }
        }
        .verification-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            border-radius: 9999px;
            padding: 0.125rem 0.625rem;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            background-color: rgba(0, 150, 57, 0.08);
            color: #009639;
        }
        @media (min-width: 640px) {
            .verification-tag { font-size: 11px; }
        }
        .tag-dot {
            height: 0.375rem;
            width: 0.375rem;
            border-radius: 50%;
            background-color: #009639;
        }
        .verification-desc {
            margin-top: 0.25rem;
            font-size: 0.75rem;
            color: #64748b;
            max-width: 42rem;
        }

        /* Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }
        @media (min-width: 640px) {
            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }

        /* Detail Card */
        .qr-field-card {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.7);
            background: rgba(255, 255, 255, 0.95);
            border-radius: 0.75rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-out;
            animation: qrFadeUp 0.35s ease-out both;
        }
        .qr-field-card:hover {
            transform: translateY(-4px);
            border-color: transparent;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .card-glow {
            position: absolute;
            inset: 0;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            background: linear-gradient(135deg, var(--qr-accent-glow) 0%, transparent 55%, var(--qr-accent-glow2) 100%);
        }
        .qr-field-card:hover .card-glow {
            opacity: 1;
        }

        .card-bar {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 4px;
            background-color: var(--qr-accent);
            transition: all 0.3s ease-out;
        }
        .qr-field-card:hover .card-bar {
            width: 6px;
            box-shadow: 2px 0 10px var(--qr-accent);
        }

        .card-content {
            position: relative;
            transition: transform 0.3s ease-out;
            padding: 0.5rem 0.875rem 0.5rem 1rem;
        }
        @media (min-width: 640px) {
            .card-content { padding: 0.625rem 1rem 0.625rem 1.25rem; }
        }
        .qr-field-card:hover .card-content {
            transform: translateX(0.625rem);
        }

        .card-title {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.025em;
            margin-bottom: 0.25rem;
            color: var(--qr-accent);
        }
        @media (min-width: 640px) {
            .card-title { font-size: 0.875rem; }
        }

        .card-value {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.5rem;
            word-break: break-word;
        }
        @media (min-width: 640px) {
            .card-value { font-size: 0.95rem; }
        }

        /* Accent Colors */
        .accent-blue {
            --qr-accent: #0055A5;
            --qr-accent-glow: rgba(0, 85, 165, 0.08);
            --qr-accent-glow2: rgba(0, 85, 165, 0.04);
        }
        .accent-red {
            --qr-accent: #E31C23;
            --qr-accent-glow: rgba(227, 28, 35, 0.08);
            --qr-accent-glow2: rgba(227, 28, 35, 0.04);
        }
        .accent-green {
            --qr-accent: #009639;
            --qr-accent-glow: rgba(0, 150, 57, 0.08);
            --qr-accent-glow2: rgba(0, 150, 57, 0.04);
        }

        /* Footer */
        footer {
            margin-top: auto;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
            background: #ffffff;
        }
        .footer-bar {
            height: 4px;
            width: 100%;
            background: linear-gradient(90deg, #0055A5 0%, #E31C23 25%, #009639 50%, #0055A5 75%, #E31C23 100%);
            background-size: 200% 100%;
            animation: qrFooterBarShift 8s linear infinite;
        }
        .footer-inner {
            max-width: 67rem;
            width: 100%;
            margin: 0 auto;
            padding: 0.75rem 0.75rem;
            text-align: center;
            font-size: 0.75rem;
            color: #64748b;
        }
        @media (min-width: 640px) {
            .footer-inner { padding: 0.875rem 1.25rem; font-size: 0.75rem; }
        }
        @media (min-width: 1024px) {
            .footer-inner { padding: 0.875rem 2rem; }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <header class="qr-header qr-animate-in">
            <div class="header-wrap">
                <div class="header-mobile">
                    <img src="{{ asset('assets/img/logo.webp') }}" alt="Dutch-Bangla Bank logo">
                    <h1>Account Statement Verification</h1>
                </div>
                <div class="header-desktop">
                    <div class="header-left">
                        <img src="{{ asset('assets/img/logo.webp') }}" alt="Dutch-Bangla Bank logo">
                        <p>Dutch-Bangla Bank PLC.</p>
                    </div>
                    <div class="header-right">
                        <div class="header-right-inner">
                            <span class="header-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 10h2"></path><path d="M16 14h2"></path><path d="M6.17 15a3 3 0 0 1 5.66 0"></path><circle cx="9" cy="11" r="2"></circle><rect x="2" y="5" width="20" height="14" rx="2"></rect></svg>
                            </span>
                            <h1>Account Statement Verification</h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="main-content">
            <div class="main-inner">
                <div class="tag-wrapper qr-animate-in">
                    <p class="verification-tag">
                        <span class="tag-dot"></span>
                        Verification Details
                    </p>
                    <p class="verification-desc">The following information was retrieved from the scanned QR Code and verified.</p>
                </div>

                <div class="cards-grid">
                    <div class="qr-field-card accent-blue" style="animation-delay: 0ms;">
                        <div class="card-glow" aria-hidden="true"></div>
                        <div class="card-bar" aria-hidden="true"></div>
                        <div class="card-content">
                            <p class="card-title" title="Account No">Account No</p>
                            <p class="card-value" title="{{ $statement->account_no }}">{{ $statement->account_no }}</p>
                        </div>
                    </div>

                    <div class="qr-field-card accent-red" style="animation-delay: 28ms;">
                        <div class="card-glow" aria-hidden="true"></div>
                        <div class="card-bar" aria-hidden="true"></div>
                        <div class="card-content">
                            <p class="card-title" title="Account Name">Account Name</p>
                            <p class="card-value" title="{{ $statement->account_name }}">{{ $statement->account_name }}</p>
                        </div>
                    </div>

                    <div class="qr-field-card accent-green" style="animation-delay: 56ms;">
                        <div class="card-glow" aria-hidden="true"></div>
                        <div class="card-bar" aria-hidden="true"></div>
                        <div class="card-content">
                            <p class="card-title" title="Opening Balance">Opening Balance</p>
                            <p class="card-value" title="{{ $statement->formatted_opening_balance }}">{{ $statement->formatted_opening_balance }}</p>
                        </div>
                    </div>

                    <div class="qr-field-card accent-blue" style="animation-delay: 84ms;">
                        <div class="card-glow" aria-hidden="true"></div>
                        <div class="card-bar" aria-hidden="true"></div>
                        <div class="card-content">
                            <p class="card-title" title="Closing Balance">Closing Balance</p>
                            <p class="card-value" title="{{ $statement->formatted_closing_balance }}">{{ $statement->formatted_closing_balance }}</p>
                        </div>
                    </div>

                    <div class="qr-field-card accent-red" style="animation-delay: 112ms;">
                        <div class="card-glow" aria-hidden="true"></div>
                        <div class="card-bar" aria-hidden="true"></div>
                        <div class="card-content">
                            <p class="card-title" title="Report Generation Date">Report Generation Date</p>
                            <p class="card-value" title="{{ $statement->formatted_generation_date }}">{{ $statement->formatted_generation_date }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer>
            <div class="footer-bar" aria-hidden="true"></div>
            <div class="footer-inner">
                <p>Copyright @ {{ date('Y') }}. Dutch-Bangla Bank</p>
            </div>
        </footer>
    </div>
</body>
</html>