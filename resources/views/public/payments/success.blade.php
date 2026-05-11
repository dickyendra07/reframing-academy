<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation Submitted - Reframing Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy: #123a56;
            --blue: #1d6f99;
            --blue-soft: #edf7fb;
            --green: #15803d;
            --green-soft: #ecfdf5;
            --orange: #c2410c;
            --orange-soft: #fff7ed;
            --text: #123047;
            --muted: #738292;
            --line: #e7edf2;
            --soft: #f8fbfd;
            --white: #ffffff;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background:
                radial-gradient(circle at top right, rgba(29, 111, 153, 0.10), transparent 34%),
                linear-gradient(180deg, #ffffff 0%, #f8fbfd 100%);
            color: var(--text);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            min-height: 100vh;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .container {
            width: min(1100px, calc(100% - 48px));
            margin: 0 auto;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255, 255, 255, 0.94);
            border-bottom: 1px solid var(--line);
            backdrop-filter: blur(14px);
        }

        .navbar-inner {
            min-height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
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
            overflow: hidden;
            border: 1px solid #d8ecf5;
            background: white;
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

        .page {
            padding: 64px 0 92px;
        }

        .success-card {
            overflow: hidden;
            border-radius: 36px;
            background: white;
            border: 1px solid var(--line);
            box-shadow: 0 24px 80px rgba(18, 58, 86, 0.10);
        }

        .success-hero {
            padding: 44px;
            background:
                radial-gradient(circle at top right, rgba(255,255,255,0.16), transparent 30%),
                linear-gradient(160deg, #15803d, #123a56);
            color: white;
            text-align: center;
        }

        .check {
            width: 78px;
            height: 78px;
            margin: 0 auto;
            border-radius: 999px;
            display: grid;
            place-items: center;
            background: rgba(255,255,255,0.16);
            border: 1px solid rgba(255,255,255,0.24);
            color: white;
            font-size: 38px;
            font-weight: 950;
        }

        .pill {
            display: inline-flex;
            margin-top: 24px;
            align-items: center;
            justify-content: center;
            padding: 9px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.14);
            color: white;
            border: 1px solid rgba(255,255,255,0.18);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1.1px;
        }

        .title {
            margin: 20px auto 0;
            max-width: 760px;
            color: white;
            font-size: clamp(34px, 4.2vw, 56px);
            line-height: 1.05;
            letter-spacing: -2px;
            font-weight: 950;
        }

        .text {
            margin: 18px auto 0;
            max-width: 720px;
            color: rgba(255,255,255,0.84);
            font-size: 16px;
            line-height: 1.8;
        }

        .content {
            padding: 38px 44px 44px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .info-box {
            border-radius: 22px;
            background: var(--soft);
            border: 1px solid var(--line);
            padding: 20px;
        }

        .info-box span {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.9px;
        }

        .info-box strong {
            display: block;
            margin-top: 8px;
            color: var(--navy);
            font-size: 16px;
            line-height: 1.35;
        }

        .status {
            display: inline-flex;
            margin-top: 8px;
            border-radius: 999px;
            background: var(--orange-soft);
            color: var(--orange);
            border: 1px solid #fed7aa;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .next-box {
            margin-top: 24px;
            border-radius: 26px;
            background: var(--blue-soft);
            border: 1px solid #d9edf6;
            padding: 24px;
            color: #31596f;
            line-height: 1.75;
            font-size: 14px;
        }

        .next-box strong {
            color: var(--navy);
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 52px;
            padding: 0 22px;
            border-radius: 999px;
            border: 1px solid transparent;
            font-size: 14px;
            font-weight: 950;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .button-primary {
            background: var(--navy);
            color: white;
            box-shadow: 0 14px 34px rgba(18, 58, 86, 0.18);
        }

        .button-primary:hover {
            background: var(--blue);
        }

        .button-outline {
            background: white;
            color: var(--navy);
            border-color: var(--line);
        }

        .button-outline:hover {
            border-color: #c8d8e2;
            background: #fbfdfe;
        }

        @media (max-width: 860px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .success-hero,
            .content {
                padding: 28px;
            }

            .actions {
                display: grid;
            }

            .button {
                width: 100%;
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
                    <p class="brand-kicker">Reframing Academy</p>
                    <p class="brand-title">Payment Confirmation</p>
                </div>
            </a>
        </div>
    </header>

    <main class="page">
        <div class="container">
            <section class="success-card">
                <div class="success-hero">
                    <div class="check">✓</div>

                    <span class="pill">Confirmation Submitted</span>

                    <h1 class="title">
                        Payment confirmation submitted successfully
                    </h1>

                    <p class="text">
                        Thank you. Your payment proof has been received by our system and is now waiting for admin review.
                    </p>
                </div>

                <div class="content">
                    <div class="info-grid">
                        <div class="info-box">
                            <span>Registration Number</span>
                            <strong>{{ $registration->registration_number }}</strong>
                        </div>

                        <div class="info-box">
                            <span>Participant</span>
                            <strong>{{ $registration->full_name }}</strong>
                        </div>

                        <div class="info-box">
                            <span>Payment Status</span>
                            <strong>
                                <span class="status">
                                    {{ strtoupper(str_replace('_', ' ', $registration->payment_status)) }}
                                </span>
                            </strong>
                        </div>

                        <div class="info-box">
                            <span>Program</span>
                            <strong>{{ $registration->program->name }}</strong>
                        </div>

                        <div class="info-box">
                            <span>Batch</span>
                            <strong>{{ $registration->batch->title }}</strong>
                        </div>

                        <div class="info-box">
                            <span>Submitted At</span>
                            <strong>
                                {{ $registration->payment_submitted_at ? \Carbon\Carbon::parse($registration->payment_submitted_at)->format('d M Y H:i') : now()->format('d M Y H:i') }}
                            </strong>
                        </div>
                    </div>

                    <div class="next-box">
                        <strong>What happens next?</strong><br>
                        Our admin team will review your payment proof. Once approved, your payment status will be updated and you will receive further confirmation from Reframing Academy.
                    </div>

                    <div class="actions">
                        @auth
                            <a href="{{ route('dashboard') }}" class="button button-primary">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="button button-primary">
                                Login to Dashboard
                            </a>
                        @endauth

                        <a href="{{ route('public.payments.show', $registration->registration_number) }}" class="button button-outline">
                            View Payment Detail
                        </a>

                        <a href="{{ route('public.programs.index') }}" class="button button-outline">
                            Back to Programs
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
