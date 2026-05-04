<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful - Reframing Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy: #123a56;
            --blue: #1d6f99;
            --blue-soft: #edf7fb;
            --green: #15803d;
            --green-soft: #ecfdf5;
            --text: #123047;
            --muted: #738292;
            --line: #e7edf2;
            --soft: #f8fbfd;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #ffffff;
            color: var(--text);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        a { color: inherit; text-decoration: none; }

        .container {
            width: min(1200px, calc(100% - 48px));
            margin: 0 auto;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255, 255, 255, 0.92);
            border-bottom: 1px solid var(--line);
            backdrop-filter: blur(14px);
        }

        .navbar-inner {
            min-height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-mark {
            width: 46px;
            height: 46px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            background: white;
            border: 1px solid #d8ecf5;
            overflow: hidden;
        }

        .brand-mark img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .brand-kicker {
            margin: 0;
            color: var(--blue);
            font-size: 11px;
            font-weight: 850;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        .brand-title {
            margin: 2px 0 0;
            color: var(--navy);
            font-size: 20px;
            line-height: 1;
            font-weight: 900;
            letter-spacing: -0.4px;
        }

        .nav-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 18px;
            border-radius: 999px;
            background: var(--navy);
            color: white;
            font-size: 14px;
            font-weight: 850;
            box-shadow: 0 10px 24px rgba(18, 58, 86, 0.14);
        }

        .page {
            padding: 64px 0 88px;
            background:
                radial-gradient(circle at top right, rgba(29, 111, 153, 0.10), transparent 34%),
                linear-gradient(180deg, #ffffff 0%, #f8fbfd 100%);
            min-height: calc(100vh - 82px);
        }

        .card {
            overflow: hidden;
            border-radius: 34px;
            background: white;
            border: 1px solid var(--line);
            box-shadow: 0 24px 70px rgba(18, 58, 86, 0.10);
        }

        .hero {
            padding: 42px;
            border-bottom: 1px solid var(--line);
        }

        .pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 14px;
            border-radius: 999px;
            background: var(--green-soft);
            color: var(--green);
            border: 1px solid #bbf7d0;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1.1px;
        }

        h1 {
            margin: 22px 0 0;
            color: var(--navy);
            font-size: clamp(36px, 4.8vw, 58px);
            line-height: 1.04;
            letter-spacing: -2.2px;
            font-weight: 950;
        }

        .lead {
            margin: 18px 0 0;
            max-width: 760px;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.75;
        }

        .content {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 28px;
            padding: 42px;
        }

        .summary {
            display: grid;
            gap: 14px;
        }

        .summary-row {
            border-radius: 22px;
            background: var(--soft);
            border: 1px solid var(--line);
            padding: 20px;
        }

        .summary-row span {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.9px;
        }

        .summary-row strong {
            display: block;
            margin-top: 8px;
            color: var(--navy);
            font-size: 17px;
            line-height: 1.35;
        }

        .registration-number strong {
            font-size: 26px;
            letter-spacing: -0.8px;
        }

        .side {
            border-radius: 28px;
            background:
                radial-gradient(circle at top right, rgba(255,255,255,0.18), transparent 30%),
                linear-gradient(160deg, #1d6f99, #123a56);
            color: white;
            padding: 30px;
            align-self: start;
        }

        .side h2 {
            margin: 0;
            font-size: 28px;
            line-height: 1.1;
            letter-spacing: -0.9px;
            font-weight: 950;
        }

        .side p {
            margin: 14px 0 0;
            color: rgba(255,255,255,0.82);
            line-height: 1.7;
            font-size: 15px;
        }

        .actions {
            display: grid;
            gap: 12px;
            margin-top: 26px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 52px;
            padding: 0 24px;
            border-radius: 16px;
            font-size: 14px;
            font-weight: 900;
            border: 1px solid transparent;
            transition: 0.2s ease;
        }

        .button-white {
            background: white;
            color: var(--navy);
        }

        .button-outline {
            background: transparent;
            color: white;
            border-color: rgba(255,255,255,0.35);
        }

        .button-outline:hover {
            background: rgba(255,255,255,0.08);
        }

        @media (max-width: 900px) {
            .content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .container { width: min(100% - 28px, 1200px); }
            .hero, .content { padding: 24px; }
            .brand-mark { width: 40px; height: 40px; }
            .brand-title { font-size: 17px; }
            .nav-action {
                padding: 0 14px;
                min-height: 38px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="container navbar-inner">
            <a href="{{ route('public.programs.index') }}" class="brand">
                <div class="brand-mark">
                    <img src="https://reframingphysio.com/wp-content/uploads/2026/02/cropped-FAVICON.png" alt="Reframing Physio">
                </div>
                <div>
                    <p class="brand-kicker">Reframing Physio</p>
                    <p class="brand-title">Academy</p>
                </div>
            </a>

            <a href="{{ route('public.programs.index') }}" class="nav-action">Programs</a>
        </div>
    </header>

    <main class="page">
        <div class="container">
            <section class="card">
                <div class="hero">
                    <span class="pill">Registration Successful</span>

                    <h1>Your registration has been received.</h1>

                    <p class="lead">
                        Please save your registration number. Continue to payment to complete your registration process.
                    </p>
                </div>

                <div class="content">
                    <div class="summary">
                        <div class="summary-row registration-number">
                            <span>Registration Number</span>
                            <strong>{{ $registration->registration_number }}</strong>
                        </div>

                        <div class="summary-row">
                            <span>Participant Name</span>
                            <strong>{{ $registration->full_name }}</strong>
                        </div>

                        <div class="summary-row">
                            <span>Program</span>
                            <strong>{{ $registration->batch->title }}</strong>
                        </div>

                        <div class="summary-row">
                            <span>Pricing Category</span>
                            <strong>{{ $registration->price->label }}</strong>
                        </div>

                        <div class="summary-row">
                            <span>Total Payment</span>
                            <strong>Rp{{ number_format($registration->total_amount, 0, ',', '.') }}</strong>
                        </div>

                        <div class="summary-row">
                            <span>Payment Status</span>
                            <strong>{{ strtoupper($registration->payment_status) }}</strong>
                        </div>
                    </div>

                    <aside class="side">
                        <h2>Complete your payment</h2>
                        <p>
                            Your seat will be processed after payment confirmation. For this development version,
                            payment is handled through a simulation page.
                        </p>

                        <div class="actions">
                            <a href="{{ route('public.payments.show', $registration) }}" class="button button-white">
                                Continue to Payment
                            </a>

                            <a href="{{ route('public.programs.index') }}" class="button button-outline">
                                Back to Programs
                            </a>
                        </div>
                    </aside>
                </div>
            </section>
        </div>
    </main>
</body>
</html>