<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $batch->title }} - Reframing Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy: #123a56;
            --blue: #1d6f99;
            --blue-soft: #edf7fb;
            --text: #123047;
            --muted: #738292;
            --line: #e7edf2;
            --soft: #f8fbfd;
            --white: #ffffff;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #ffffff;
            color: var(--text);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .container {
            width: min(1600px, calc(100% - 48px));
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

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
            color: #516273;
            font-size: 14px;
            font-weight: 700;
        }

        .nav-links a:hover { color: var(--blue); }

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

        .hero {
            padding: 72px 0 42px;
            background:
                radial-gradient(circle at top right, rgba(29, 111, 153, 0.10), transparent 34%),
                linear-gradient(180deg, #ffffff 0%, #f8fbfd 100%);
            border-bottom: 1px solid var(--line);
        }

        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
            color: var(--muted);
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 28px;
        }

        .breadcrumb a { color: var(--blue); }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 36px;
            align-items: stretch;
        }

        .hero-main {
            border-radius: 34px;
            background: white;
            border: 1px solid var(--line);
            box-shadow: 0 22px 60px rgba(18, 58, 86, 0.07);
            padding: 42px;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 14px;
            border-radius: 999px;
            background: var(--blue-soft);
            color: var(--blue);
            border: 1px solid #d9edf6;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1.1px;
        }

        .hero-title {
            margin: 22px 0 0;
            color: var(--navy);
            font-size: clamp(38px, 4.8vw, 64px);
            line-height: 1.04;
            letter-spacing: -2.4px;
            font-weight: 950;
        }

        .hero-description {
            margin: 20px 0 0;
            max-width: 880px;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.78;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-top: 34px;
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

        .hero-side {
            border-radius: 34px;
            background:
                radial-gradient(circle at top right, rgba(255,255,255,0.18), transparent 30%),
                linear-gradient(160deg, #1d6f99, #123a56);
            color: white;
            padding: 42px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 22px 60px rgba(18, 58, 86, 0.12);
        }

        .side-label {
            margin: 0;
            color: rgba(255,255,255,0.72);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .side-price {
            margin: 10px 0 0;
            font-size: 42px;
            line-height: 1;
            letter-spacing: -1.4px;
            font-weight: 950;
        }

        .side-text {
            margin: 20px 0 0;
            color: rgba(255,255,255,0.82);
            line-height: 1.75;
            font-size: 15px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            padding: 0 24px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 850;
            border: 1px solid transparent;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .button-primary {
            background: white;
            color: var(--navy);
        }

        .button-primary:hover { background: #f4fbfe; }

        .button-blue {
            background: var(--blue);
            color: white;
            box-shadow: 0 16px 36px rgba(29, 111, 153, 0.20);
        }

        .button-blue:hover { background: var(--navy); }

        .button-outline {
            background: white;
            color: var(--navy);
            border-color: var(--line);
        }

        .button-outline:hover {
            border-color: #c8d8e2;
            background: #fbfdfe;
        }

        .side-actions {
            display: grid;
            gap: 12px;
            margin-top: 34px;
        }

        .content {
            padding: 72px 0 86px;
            background: white;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 28px;
            align-items: start;
        }

        .panel {
            border-radius: 34px;
            background: white;
            border: 1px solid var(--line);
            box-shadow: 0 18px 55px rgba(18, 58, 86, 0.06);
            padding: 34px;
        }

        .panel-title {
            margin: 0;
            color: var(--navy);
            font-size: 30px;
            line-height: 1.12;
            letter-spacing: -1px;
            font-weight: 950;
        }

        .panel-subtitle {
            margin: 10px 0 0;
            color: var(--muted);
            line-height: 1.7;
        }

        .price-list {
            display: grid;
            gap: 14px;
            margin-top: 28px;
        }

        .price-card {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 24px;
            align-items: start;
            border-radius: 24px;
            background: var(--soft);
            border: 1px solid var(--line);
            padding: 22px;
        }

        .price-card h3 {
            margin: 0;
            color: var(--navy);
            font-size: 20px;
            font-weight: 950;
            letter-spacing: -0.4px;
        }

        .price-card p {
            margin: 8px 0 0;
            color: var(--muted);
            line-height: 1.6;
            font-size: 14px;
        }

        .price-amount {
            color: var(--navy);
            font-size: 22px;
            line-height: 1.1;
            font-weight: 950;
            white-space: nowrap;
        }

        .requirements {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 14px;
        }

        .requirement {
            display: inline-flex;
            border-radius: 999px;
            background: white;
            color: var(--blue);
            border: 1px solid #d9edf6;
            padding: 7px 10px;
            font-size: 12px;
            font-weight: 850;
        }

        .sidebar {
            position: sticky;
            top: 106px;
            display: grid;
            gap: 18px;
        }

        .registration-card {
            border-radius: 34px;
            background: var(--soft);
            border: 1px solid var(--line);
            padding: 30px;
        }

        .registration-card h2 {
            margin: 18px 0 0;
            color: var(--navy);
            font-size: 26px;
            letter-spacing: -0.8px;
            font-weight: 950;
        }

        .registration-card p {
            margin: 12px 0 0;
            color: var(--muted);
            line-height: 1.7;
            font-size: 15px;
        }

        .registration-card .button {
            width: 100%;
            margin-top: 24px;
        }

        .note-card {
            border-radius: 28px;
            background: white;
            border: 1px solid var(--line);
            padding: 24px;
        }

        .note-card h3 {
            margin: 0;
            color: var(--navy);
            font-size: 18px;
            font-weight: 950;
        }

        .note-card p {
            margin: 10px 0 0;
            color: var(--muted);
            line-height: 1.7;
            font-size: 14px;
        }

        @media (max-width: 1180px) {
            .hero-grid,
            .content-grid { grid-template-columns: 1fr; }
            .info-grid { grid-template-columns: repeat(2, 1fr); }
            .sidebar { position: static; }
        }

        @media (max-width: 900px) {
            .nav-links { display: none; }
        }

        @media (max-width: 640px) {
            .container { width: min(100% - 28px, 1600px); }
            .navbar-inner { min-height: 72px; }
            .brand-mark { width: 40px; height: 40px; }
            .brand-title { font-size: 17px; }
            .nav-action {
                padding: 0 14px;
                min-height: 38px;
                font-size: 13px;
            }
            .hero { padding: 42px 0 28px; }
            .hero-main,
            .hero-side,
            .panel,
            .registration-card { padding: 24px; }
            .hero-title { letter-spacing: -1.7px; }
            .info-grid,
            .price-card { grid-template-columns: 1fr; }
            .side-price { font-size: 32px; }
            .price-amount { white-space: normal; }
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

            <nav class="nav-links">
                <a href="{{ route('public.programs.index') }}">Programs</a>
                <a href="{{ route('public.programs.index') }}#flow">Registration Flow</a>
                <a href="https://api.whatsapp.com/send?phone=628889637876">Contact</a>
            </nav>

            @auth
                <a href="{{ route('dashboard') }}" class="nav-action">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="nav-action">Login</a>
            @endauth
        </div>
    </header>

    @php
        $lowestPrice = $batch->prices->where('status', 'active')->min('amount');
    @endphp

    <main>
        <section class="hero">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('public.programs.index') }}">Programs</a>
                    <span>/</span>
                    <span>{{ $batch->title }}</span>
                </div>

                <div class="hero-grid">
                    <div class="hero-main">
                        <span class="pill">{{ $batch->program->code }}</span>

                        <h1 class="hero-title">
                            {{ $batch->title }}
                        </h1>

                        <p class="hero-description">
                            {{ $batch->program->description }}
                        </p>

                        <div class="info-grid">
                            <div class="info-box">
                                <span>Program</span>
                                <strong>{{ $batch->program->name }}</strong>
                            </div>

                            <div class="info-box">
                                <span>Location</span>
                                <strong>{{ $batch->location }}</strong>
                            </div>

                            <div class="info-box">
                                <span>Date</span>
                                <strong>
                                    {{ $batch->start_date->format('d M Y') }} - {{ $batch->end_date->format('d M Y') }}
                                </strong>
                            </div>

                            <div class="info-box">
                                <span>Quota</span>
                                <strong>{{ $batch->quota ? $batch->quota . ' participants' : 'Limited seats' }}</strong>
                            </div>
                        </div>
                    </div>

                    <aside class="hero-side">
                        <div>
                            <p class="side-label">Program Pricing</p>
                            <p class="side-price">Available at Payment Step</p>

                            <p class="side-text">
                                Complete your registration first. Pricing and payment details will be shown at the payment step.
                            </p>
                        </div>

                        <div class="side-actions">
                            <a href="{{ route('public.registrations.create', $batch) }}" class="button button-primary">
                                Register Now
                            </a>

                            <a href="{{ route('public.programs.index') }}" class="button button-outline">
                                Back to Programs
                            </a>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container content-grid">
                <div class="panel">
                    <h2 class="panel-title">Pricing Categories</h2>
                    <p class="panel-subtitle">
                        Select the category that matches your professional background or registration eligibility. Pricing will be shown at the payment step.
                    </p>

                    <div class="price-list">
                        @foreach ($batch->prices->where('status', 'active') as $price)
                            <article class="price-card">
                                <div>
                                    <h3>{{ $price->label }}</h3>

                                    <p>{{ $price->description }}</p>

                                    <div class="requirements">
                                        @if ($price->requires_profession)
                                            <span class="requirement">Profession: {{ $price->requires_profession }}</span>
                                        @endif

                                        @if ($price->requires_alumni_number)
                                            <span class="requirement">Alumni number required</span>
                                        @endif

                                        @if ($price->requires_group_name)
                                            <span class="requirement">Group name required</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="price-amount">
                                    Shown at payment step
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <aside class="sidebar">
                    <div class="registration-card">
                        <span class="pill">Registration</span>

                        <h2>Ready to join this program?</h2>

                        <p>
                            Complete the registration form once. Your program, pricing category, participant data,
                            and payment status will be connected in one dashboard.
                        </p>

                        <a href="{{ route('public.registrations.create', $batch) }}" class="button button-blue">
                            Register Now
                        </a>
                    </div>

                    <div class="note-card">
                        <h3>Need help?</h3>
                        <p>
                            Contact the Reframing team if you are unsure which pricing category or program is right for you.
                        </p>

                        <a href="https://api.whatsapp.com/send?phone=628889637876" class="button button-outline" style="width: 100%; margin-top: 18px;">
                            Contact Our Team
                        </a>
                    </div>
                </aside>
            </div>
        </section>
    </main>
</body>
</html>