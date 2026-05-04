<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reframing Academy - Certification Programs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy: #123a56;
            --blue: #1d6f99;
            --blue-soft: #edf7fb;
            --orange: #f26722;
            --text: #123047;
            --muted: #738292;
            --line: #e7edf2;
            --soft: #f8fbfd;
            --white: #ffffff;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

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
            padding: 82px 0 62px;
            background:
                radial-gradient(circle at top right, rgba(29, 111, 153, 0.10), transparent 34%),
                linear-gradient(180deg, #ffffff 0%, #f8fbfd 100%);
        }

        .hero-content {
            max-width: 1080px;
            margin: 0 auto;
            text-align: center;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 18px;
            border-radius: 999px;
            background: var(--blue-soft);
            color: var(--blue);
            border: 1px solid #d9edf6;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1.3px;
        }

        .hero-title {
            margin: 26px auto 0;
            max-width: 1040px;
            color: var(--navy);
            font-size: clamp(42px, 5vw, 76px);
            line-height: 1.04;
            letter-spacing: -3px;
            font-weight: 950;
        }

        .hero-subtitle {
            margin: 24px auto 0;
            max-width: 860px;
            color: var(--muted);
            font-size: 18px;
            line-height: 1.8;
        }

        .hero-actions {
            margin-top: 34px;
            display: flex;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
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
            background: var(--blue);
            color: white;
            box-shadow: 0 16px 36px rgba(29, 111, 153, 0.20);
        }

        .button-primary:hover { background: var(--navy); }

        .button-secondary {
            background: white;
            color: var(--navy);
            border-color: var(--line);
        }

        .button-secondary:hover {
            border-color: #c8d8e2;
            background: #fbfdfe;
        }

        .button-blue {
            background: var(--navy);
            color: white;
        }

        .button-blue:hover { background: var(--blue); }

        .overview {
            padding: 24px 0 64px;
            background: var(--soft);
        }

        .overview-card {
            border-radius: 34px;
            background: white;
            border: 1px solid var(--line);
            box-shadow: 0 22px 60px rgba(18, 58, 86, 0.08);
            padding: 28px;
        }

        .overview-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .overview-item {
            border-radius: 24px;
            background: linear-gradient(180deg, #ffffff, #f8fbfd);
            border: 1px solid var(--line);
            padding: 24px;
        }

        .overview-icon {
            width: 46px;
            height: 46px;
            display: grid;
            place-items: center;
            border-radius: 16px;
            background: var(--blue-soft);
            color: var(--blue);
            font-weight: 950;
            margin-bottom: 18px;
        }

        .overview-item h3 {
            margin: 0;
            color: var(--navy);
            font-size: 20px;
            letter-spacing: -0.5px;
            font-weight: 900;
        }

        .overview-item p {
            margin: 9px 0 0;
            color: var(--muted);
            line-height: 1.65;
            font-size: 15px;
        }

        .programs {
            padding: 84px 0 92px;
            background: white;
        }

        .section-head {
            max-width: 940px;
            margin: 0 auto 42px;
            text-align: center;
        }

        .section-title {
            margin: 18px 0 0;
            color: var(--navy);
            font-size: clamp(34px, 4vw, 58px);
            line-height: 1.08;
            letter-spacing: -2px;
            font-weight: 950;
        }

        .section-description {
            margin: 18px auto 0;
            max-width: 760px;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.75;
        }

        .program-detail {
            margin-top: 26px;
            border-radius: 34px;
            background: #ffffff;
            border: 1px solid var(--line);
            box-shadow: 0 22px 65px rgba(18, 58, 86, 0.08);
            overflow: hidden;
        }

        .program-detail-inner {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
        }

        .program-detail-main { padding: 42px; }

        .detail-kicker {
            display: inline-flex;
            border-radius: 999px;
            background: var(--blue-soft);
            color: var(--blue);
            padding: 9px 14px;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .program-detail-main h3 {
            margin: 22px 0 0;
            color: var(--navy);
            font-size: clamp(30px, 4vw, 48px);
            line-height: 1.1;
            letter-spacing: -1.6px;
            font-weight: 950;
        }

        .program-detail-main p {
            margin: 14px 0 0;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.75;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-top: 30px;
        }

        .detail-box {
            border-radius: 22px;
            background: #f8fbfd;
            border: 1px solid var(--line);
            padding: 20px;
        }

        .detail-box span {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.9px;
        }

        .detail-box strong {
            display: block;
            margin-top: 8px;
            color: var(--navy);
            font-size: 16px;
            line-height: 1.35;
        }

        .program-detail-side {
            background:
                radial-gradient(circle at top right, rgba(255,255,255,0.18), transparent 30%),
                linear-gradient(160deg, #1d6f99, #123a56);
            color: white;
            padding: 42px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .price-label {
            margin: 0;
            color: rgba(255,255,255,0.72);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .price-value {
            margin: 10px 0 0;
            font-size: 40px;
            line-height: 1;
            letter-spacing: -1.4px;
            font-weight: 950;
        }

        .side-note {
            margin: 18px 0 0;
            color: rgba(255,255,255,0.80);
            line-height: 1.7;
            font-size: 15px;
        }

        .program-detail-side .button {
            width: 100%;
            background: white;
            color: var(--navy);
            margin-top: 28px;
        }

        .all-programs {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-top: 28px;
        }

        .mini-program {
            border-radius: 24px;
            border: 1px solid var(--line);
            background: white;
            padding: 22px;
        }

        .program-badge {
            width: fit-content;
            border-radius: 999px;
            background: var(--blue-soft);
            color: var(--blue);
            border: 1px solid #d9edf6;
            padding: 7px 12px;
            font-size: 12px;
            font-weight: 900;
        }

        .mini-program h4 {
            margin: 14px 0 0;
            color: var(--navy);
            font-size: 20px;
            line-height: 1.2;
            font-weight: 900;
            letter-spacing: -0.5px;
        }

        .mini-program dl {
            margin: 18px 0 0;
            display: grid;
            gap: 12px;
        }

        .mini-program div { display: grid; gap: 3px; }

        .mini-program dt {
            color: var(--muted);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .mini-program dd {
            margin: 0;
            color: var(--text);
            font-size: 14px;
            font-weight: 750;
        }

        .mini-program .button {
            width: 100%;
            margin-top: 20px;
            min-height: 46px;
        }

        .closing {
            padding: 76px 0;
            background: var(--soft);
        }

        .closing-card {
            border-radius: 34px;
            background: white;
            border: 1px solid var(--line);
            box-shadow: 0 20px 54px rgba(18, 58, 86, 0.07);
            padding: 38px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 28px;
            align-items: center;
        }

        .closing-card h2 {
            margin: 18px 0 0;
            color: var(--navy);
            font-size: clamp(30px, 4vw, 44px);
            line-height: 1.1;
            letter-spacing: -1.5px;
            font-weight: 950;
        }

        .closing-card p {
            margin: 14px 0 0;
            max-width: 820px;
            color: var(--muted);
            line-height: 1.75;
        }

        @media (max-width: 1180px) {
            .detail-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 1000px) {
            .nav-links { display: none; }
            .overview-grid,
            .all-programs { grid-template-columns: 1fr; }
            .program-detail-inner,
            .closing-card { grid-template-columns: 1fr; }
            .detail-grid { grid-template-columns: 1fr; }
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
            .hero { padding: 52px 0 38px; }
            .hero-title { letter-spacing: -1.8px; }
            .overview-card,
            .program-detail-main,
            .program-detail-side,
            .closing-card { padding: 24px; }
            .price-value { font-size: 30px; }
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
                <a href="#programs">Programs</a>
                <a href="#flow">Registration Flow</a>
                <a href="https://api.whatsapp.com/send?phone=628889637876">Contact</a>
            </nav>

            @auth
                <a href="{{ route('dashboard') }}" class="nav-action">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="nav-action">Login</a>
            @endauth
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <div class="pill">Offline Certification Programs</div>

                    <h1 class="hero-title">
                        Choose your certification program and register in one simple flow.
                    </h1>

                    <p class="hero-subtitle">
                        Reframing Academy helps participants choose offline certification programs, complete registration data,
                        select the right pricing category, and continue payment in one seamless flow.
                    </p>

                    <div class="hero-actions">
                        <a href="#programs" class="button button-primary">Browse Programs</a>
                        <a href="https://api.whatsapp.com/send?phone=628889637876" class="button button-secondary">Contact Our Team</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="flow" class="overview">
            <div class="container">
                <div class="overview-card">
                    <div class="overview-grid">
                        <div class="overview-item">
                            <div class="overview-icon">01</div>
                            <h3>Choose a program</h3>
                            <p>Explore available batches, locations, schedules, and starting prices.</p>
                        </div>

                        <div class="overview-item">
                            <div class="overview-icon">02</div>
                            <h3>Complete your details</h3>
                            <p>Fill in participant, profession, and required administrative information.</p>
                        </div>

                        <div class="overview-item">
                            <div class="overview-icon">03</div>
                            <h3>Continue to payment</h3>
                            <p>Your registration is saved instantly and can be tracked from your dashboard.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="programs" class="programs">
            <div class="container">
                <div class="section-head">
                    <div class="pill">Available Batches</div>

                    <h2 class="section-title">
                        Available certification programs
                    </h2>

                    <p class="section-description">
                        Choose a batch to view program details, pricing categories, and continue to the registration form.
                    </p>
                </div>

                @php
                    $featuredBatch = $batches->first();
                    $featuredLowestPrice = $featuredBatch?->prices?->where('status', 'active')->min('amount');
                @endphp

                @if ($featuredBatch)
                    <div class="program-detail">
                        <div class="program-detail-inner">
                            <div class="program-detail-main">
                                <span class="detail-kicker">{{ $featuredBatch->program->code }}</span>

                                <h3>{{ $featuredBatch->title }}</h3>

                                <p>
                                    {{ $featuredBatch->program->name }}. Offline certification program with a simplified
                                    registration process and participant data saved directly into the system.
                                </p>

                                <div class="detail-grid">
                                    <div class="detail-box">
                                        <span>Location</span>
                                        <strong>{{ $featuredBatch->location }}</strong>
                                    </div>

                                    <div class="detail-box">
                                        <span>Date</span>
                                        <strong>
                                            {{ $featuredBatch->start_date->format('d M Y') }} - {{ $featuredBatch->end_date->format('d M Y') }}
                                        </strong>
                                    </div>

                                    <div class="detail-box">
                                        <span>Program</span>
                                        <strong>{{ $featuredBatch->program->name }}</strong>
                                    </div>

                                    <div class="detail-box">
                                        <span>Quota</span>
                                        <strong>{{ $featuredBatch->quota ? $featuredBatch->quota . ' participants' : 'Limited seats' }}</strong>
                                    </div>
                                </div>
                            </div>

                            <aside class="program-detail-side">
                                <div>
                                    <p class="price-label">Starts from</p>
                                    <p class="price-value">
                                        Rp{{ number_format($featuredLowestPrice ?? 0, 0, ',', '.') }}
                                    </p>

                                    <p class="side-note">
                                        Complete pricing categories are available on the program detail page.
                                    </p>
                                </div>

                                <a href="{{ route('public.programs.show', $featuredBatch) }}" class="button">
                                    View Program Detail
                                </a>
                            </aside>
                        </div>
                    </div>
                @endif

                <div class="all-programs">
                    @forelse ($batches as $batch)
                        @php
                            $lowestPrice = $batch->prices->where('status', 'active')->min('amount');
                        @endphp

                        <article class="mini-program">
                            <span class="program-badge">{{ $batch->program->code }}</span>

                            <h4>{{ $batch->title }}</h4>

                            <dl>
                                <div>
                                    <dt>Location</dt>
                                    <dd>{{ $batch->location }}</dd>
                                </div>

                                <div>
                                    <dt>Date</dt>
                                    <dd>{{ $batch->start_date->format('d M Y') }} - {{ $batch->end_date->format('d M Y') }}</dd>
                                </div>

                                <div>
                                    <dt>Starts from</dt>
                                    <dd>Rp{{ number_format($lowestPrice ?? 0, 0, ',', '.') }}</dd>
                                </div>
                            </dl>

                            <a href="{{ route('public.programs.show', $batch) }}" class="button button-blue">
                                View Detail
                            </a>
                        </article>
                    @empty
                        <article class="mini-program">
                            <h4>No programs available yet.</h4>
                            <p>Please check again later.</p>
                        </article>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="closing">
            <div class="container">
                <div class="closing-card">
                    <div>
                        <div class="pill">Need Assistance?</div>
                        <h2>Need help choosing the right program?</h2>
                        <p>
                            Contact the Reframing team to get a program recommendation based on your profession,
                            experience, and clinical development needs.
                        </p>
                    </div>

                    <a href="https://api.whatsapp.com/send?phone=628889637876" class="button button-primary">
                        Contact Reframing Team
                    </a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>