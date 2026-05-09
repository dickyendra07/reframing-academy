<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for {{ $batch->title }} - Reframing Academy</title>
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
            --danger-bg: #fff1f2;
            --danger-text: #be123c;
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

        .nav-links a:hover {
            color: var(--blue);
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

        .hero {
            padding: 62px 0 38px;
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

        .breadcrumb a {
            color: var(--blue);
        }

        .hero-card {
            border-radius: 34px;
            background: white;
            border: 1px solid var(--line);
            box-shadow: 0 22px 60px rgba(18, 58, 86, 0.07);
            padding: 42px;
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 32px;
            align-items: end;
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
            font-size: clamp(36px, 4.8vw, 58px);
            line-height: 1.04;
            letter-spacing: -2.2px;
            font-weight: 950;
        }

        .hero-text {
            margin: 18px 0 0;
            max-width: 760px;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.75;
        }

        .summary-card {
            border-radius: 28px;
            background:
                radial-gradient(circle at top right, rgba(255,255,255,0.18), transparent 30%),
                linear-gradient(160deg, #1d6f99, #123a56);
            color: white;
            padding: 28px;
        }

        .summary-label {
            margin: 0;
            color: rgba(255,255,255,0.72);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .summary-value {
            margin: 9px 0 0;
            font-size: 22px;
            line-height: 1.25;
            font-weight: 950;
        }

        .summary-meta {
            display: grid;
            gap: 12px;
            margin-top: 22px;
        }

        .summary-meta div {
            border-radius: 18px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.14);
            padding: 14px;
        }

        .summary-meta span {
            display: block;
            color: rgba(255,255,255,0.72);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .summary-meta strong {
            display: block;
            margin-top: 6px;
            color: white;
            font-size: 15px;
            line-height: 1.35;
        }

        .content {
            padding: 62px 0 86px;
            background: white;
        }

        .form-layout {
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 28px;
            align-items: start;
        }

        .form-stack {
            display: grid;
            gap: 22px;
        }

        .panel {
            border-radius: 34px;
            background: white;
            border: 1px solid var(--line);
            box-shadow: 0 18px 55px rgba(18, 58, 86, 0.06);
            padding: 34px;
        }

        .panel-header {
            margin-bottom: 26px;
        }

        .step-label {
            display: inline-flex;
            border-radius: 999px;
            background: var(--blue-soft);
            color: var(--blue);
            border: 1px solid #d9edf6;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.9px;
        }

        .panel-title {
            margin: 16px 0 0;
            color: var(--navy);
            font-size: 28px;
            line-height: 1.12;
            letter-spacing: -0.9px;
            font-weight: 950;
        }

        .panel-description {
            margin: 10px 0 0;
            color: var(--muted);
            line-height: 1.7;
            font-size: 15px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        label {
            color: var(--navy);
            font-size: 14px;
            font-weight: 850;
        }

        .hint {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        input,
        select {
            width: 100%;
            min-height: 48px;
            border-radius: 16px;
            border: 1px solid #d7e2ea;
            background: white;
            color: var(--text);
            padding: 0 15px;
            font-size: 15px;
            outline: none;
            transition: 0.2s ease;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            padding-right: 46px;
            background-image:
                linear-gradient(45deg, transparent 50%, var(--blue) 50%),
                linear-gradient(135deg, var(--blue) 50%, transparent 50%);
            background-position:
                calc(100% - 24px) 50%,
                calc(100% - 18px) 50%;
            background-size:
                6px 6px,
                6px 6px;
            background-repeat: no-repeat;
            cursor: pointer;
        }

        input:focus,
        select:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(29, 111, 153, 0.10);
        }

        .price-list {
            display: grid;
            gap: 14px;
        }

        .price-option {
            position: relative;
            display: block;
            cursor: pointer;
            border-radius: 24px;
            border: 1px solid var(--line);
            background: var(--soft);
            padding: 22px;
            transition: 0.2s ease;
        }

        .price-option:hover {
            border-color: #c8d8e2;
            background: #ffffff;
            box-shadow: 0 16px 40px rgba(18, 58, 86, 0.07);
        }

        .price-option-inner {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 16px;
            align-items: start;
        }

        .price-option input {
            width: 18px;
            height: 18px;
            min-height: unset;
            margin-top: 3px;
            accent-color: var(--blue);
        }

        .price-title {
            margin: 0;
            color: var(--navy);
            font-size: 20px;
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.4px;
        }

        .price-description {
            margin: 8px 0 0;
            color: var(--muted);
            line-height: 1.6;
            font-size: 14px;
        }

        .price-amount {
            color: var(--navy);
            font-size: 22px;
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

        .checkbox-list {
            display: grid;
            gap: 14px;
        }

        .checkbox-row {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 12px;
            align-items: start;
            padding: 18px;
            border-radius: 20px;
            background: var(--soft);
            border: 1px solid var(--line);
        }

        .checkbox-row input {
            width: 18px;
            height: 18px;
            min-height: unset;
            margin-top: 2px;
            accent-color: var(--blue);
        }

        .checkbox-row span {
            color: var(--muted);
            line-height: 1.65;
            font-size: 14px;
        }

        .sidebar {
            position: sticky;
            top: 106px;
            display: grid;
            gap: 18px;
        }

        .sidebar-card {
            border-radius: 34px;
            background: var(--soft);
            border: 1px solid var(--line);
            padding: 30px;
        }

        .sidebar-card h2 {
            margin: 16px 0 0;
            color: var(--navy);
            font-size: 26px;
            letter-spacing: -0.8px;
            font-weight: 950;
        }

        .sidebar-card p {
            margin: 12px 0 0;
            color: var(--muted);
            line-height: 1.7;
            font-size: 15px;
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
            cursor: pointer;
            transition: 0.2s ease;
        }

        .button-blue {
            width: 100%;
            background: var(--blue);
            color: white;
            box-shadow: 0 16px 36px rgba(29, 111, 153, 0.20);
        }

        .button-blue:hover {
            background: var(--navy);
        }

        .button-outline {
            width: 100%;
            background: white;
            color: var(--navy);
            border-color: var(--line);
        }

        .button-outline:hover {
            border-color: #c8d8e2;
            background: #fbfdfe;
        }

        .error-box {
            margin-bottom: 24px;
            border-radius: 24px;
            background: var(--danger-bg);
            color: var(--danger-text);
            border: 1px solid #fecdd3;
            padding: 20px;
        }

        .error-box strong {
            display: block;
            margin-bottom: 8px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }

        @media (max-width: 1180px) {
            .hero-card,
            .form-layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
            }
        }

        @media (max-width: 900px) {
            .nav-links {
                display: none;
            }

            .grid-2,
            .price-option-inner {
                grid-template-columns: 1fr;
            }

            .price-amount {
                white-space: normal;
            }
        }

        @media (max-width: 640px) {
            .container {
                width: min(100% - 28px, 1600px);
            }

            .navbar-inner {
                min-height: 72px;
            }

            .brand-mark {
                width: 40px;
                height: 40px;
            }

            .brand-title {
                font-size: 17px;
            }

            .nav-action {
                padding: 0 14px;
                min-height: 38px;
                font-size: 13px;
            }

            .hero {
                padding: 42px 0 28px;
            }

            .hero-card,
            .panel,
            .sidebar-card {
                padding: 24px;
            }

            .hero-title {
                letter-spacing: -1.7px;
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

    <main>
        <section class="hero">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('public.programs.index') }}">Programs</a>
                    <span>/</span>
                    <a href="{{ route('public.programs.show', $batch) }}">{{ $batch->title }}</a>
                    <span>/</span>
                    <span>Registration</span>
                </div>

                <div class="hero-card">
                    <div>
                        <span class="pill">Program Registration</span>

                        <h1 class="hero-title">
                            Register for {{ $batch->title }}
                        </h1>

                        <p class="hero-text">
                            Complete your participant information, select the right pricing category,
                            and continue to payment in one streamlined registration flow.
                        </p>
                    </div>

                    <aside class="summary-card">
                        <p class="summary-label">{{ $batch->program->code }}</p>
                        <p class="summary-value">{{ $batch->program->name }}</p>

                        <div class="summary-meta">
                            <div>
                                <span>Location</span>
                                <strong>{{ $batch->location }}</strong>
                            </div>

                            <div>
                                <span>Date</span>
                                <strong>{{ $batch->start_date->format('d M Y') }} - {{ $batch->end_date->format('d M Y') }}</strong>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container">
                @if ($errors->any())
                    <div class="error-box">
                        <strong>Please review the following information:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('public.registrations.store', $batch) }}" class="form-layout">
                    @csrf

                    <div class="form-stack">
                        <section class="panel">
                            <div class="panel-header">
                                <span class="step-label">Step 01</span>
                                <h2 class="panel-title">Participant Information</h2>
                                <p class="panel-description">
                                    Please enter your personal contact details as accurately as possible.
                                </p>
                            </div>

                            <div class="grid-2">
                                <div class="field">
                                    <label>Full name with title *</label>
                                    <input type="text" name="full_name" value="{{ old('full_name') }}" required>
                                </div>

                                <div class="field">
                                    <label>Email *</label>
                                    <input type="email" name="email" value="{{ old('email') }}" required>
                                </div>

                                <div class="field">
                                    <label>WhatsApp number *</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" required>
                                </div>

                                <div class="field">
                                    <label>Province</label>
                                    <input type="text" name="province" value="{{ old('province') }}">
                                </div>

                                <div class="field">
                                    <label>City / Regency</label>
                                    <input type="text" name="city" value="{{ old('city') }}">
                                </div>

                                <div class="field">
                                    <label>Institution / Workplace</label>
                                    <input type="text" name="institution" value="{{ old('institution') }}">
                                </div>
                            </div>
                        </section>

                        <section class="panel">
                            <div class="panel-header">
                                <span class="step-label">Step 02</span>
                                <h2 class="panel-title">Professional Information</h2>
                                <p class="panel-description">
                                    This information helps the admin verify eligibility for specific pricing categories.
                                </p>
                            </div>

                            <div class="grid-2">
                                <div class="field">
                                    <label>Profession</label>
                                    <select name="profession">
                                        <option value="">Select profession</option>
                                        <option value="Dokter" @selected(old('profession') === 'Dokter')>Doctor</option>
                                        <option value="Fisioterapis" @selected(old('profession') === 'Fisioterapis')>Physiotherapist</option>
                                        <option value="Lainnya" @selected(old('profession') === 'Lainnya')>Other</option>
                                    </select>
                                </div>

                                <div class="field">
                                    <label>Latest education</label>
                                    <input type="text" name="education" value="{{ old('education') }}">
                                </div>

                                <div class="field">
                                    <label>NIK / Identity number</label>
                                    <input type="text" name="nik_number" value="{{ old('nik_number') }}">
                                </div>

                                <div class="field">
                                    <label>STR number</label>
                                    <input type="text" name="str_number" value="{{ old('str_number') }}">
                                </div>
                            </div>
                        </section>

                        <section class="panel">
                            <div class="panel-header">
                                <span class="step-label">Step 03</span>
                                <h2 class="panel-title">Dresscode Information</h2>
                                <p class="panel-description">
                                    Please select your shirt and handscoon size for event preparation.
                                </p>
                            </div>

                            <div class="grid-2">
                                <div class="field">
                                    <label>Shirt size</label>
                                    <select name="shirt_size">
                                        <option value="">Select shirt size</option>
                                        <option value="XS" @selected(old('shirt_size') === 'XS')>XS</option>
                                        <option value="S" @selected(old('shirt_size') === 'S')>S</option>
                                        <option value="M" @selected(old('shirt_size') === 'M')>M</option>
                                        <option value="L" @selected(old('shirt_size') === 'L')>L</option>
                                        <option value="XL" @selected(old('shirt_size') === 'XL')>XL</option>
                                        <option value="XXL" @selected(old('shirt_size') === 'XXL')>XXL</option>
                                        <option value="XXXL" @selected(old('shirt_size') === 'XXXL')>XXXL</option>
                                    </select>
                                </div>

                                <div class="field">
                                    <label>Handscoon size</label>
                                    <select name="glove_size">
                                        <option value="">Select handscoon size</option>
                                        <option value="XS" @selected(old('glove_size') === 'XS')>XS</option>
                                        <option value="S" @selected(old('glove_size') === 'S')>S</option>
                                        <option value="M" @selected(old('glove_size') === 'M')>M</option>
                                        <option value="L" @selected(old('glove_size') === 'L')>L</option>
                                        <option value="XL" @selected(old('glove_size') === 'XL')>XL</option>
                                    </select>
                                </div>
                            </div>
                        </section>

                        <section class="panel">
                            <div class="panel-header">
                                <span class="step-label">Step 04</span>
                                <h2 class="panel-title">Pricing Category</h2>
                                <p class="panel-description">
                                    Choose the pricing category that matches your professional background or registration eligibility.
                                </p>
                            </div>

                            <div class="price-list">
                                @foreach ($batch->prices->where('status', 'active') as $price)
                                    <label class="price-option">
                                        <div class="price-option-inner">
                                            <input
                                                type="radio"
                                                name="program_price_id"
                                                value="{{ $price->id }}"
                                                required
                                                @checked(old('program_price_id') == $price->id)
                                            >

                                            <div>
                                                <h3 class="price-title">{{ $price->label }}</h3>
                                                <p class="price-description">{{ $price->description }}</p>

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
                                                Rp{{ number_format($price->amount, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            <div class="grid-2" style="margin-top: 22px;">
                                <div class="field">
                                    <label>Alumni number</label>
                                    <input type="text" name="alumni_number" value="{{ old('alumni_number') }}">
                                    <div class="hint">Only required if you choose an alumni pricing category.</div>
                                </div>

                                <div class="field">
                                    <label>Group name</label>
                                    <input type="text" name="group_name" value="{{ old('group_name') }}">
                                    <div class="hint">Only required if you choose a group pricing category.</div>
                                </div>
                            </div>
                        </section>

                        <section class="panel">
                            <div class="panel-header">
                                <span class="step-label">Step 05</span>
                                <h2 class="panel-title">Confirmation</h2>
                                <p class="panel-description">
                                    Please confirm that your data is accurate before continuing.
                                </p>
                            </div>

                            <div class="checkbox-list">
                                <label class="checkbox-row">
                                    <input type="checkbox" name="data_confirmation_accepted" value="1" required>
                                    <span>
                                        I confirm that all information provided in this registration form is accurate.
                                    </span>
                                </label>

                                <label class="checkbox-row">
                                    <input type="checkbox" name="terms_accepted" value="1" required>
                                    <span>
                                        I have read and agree to the program terms, including payment and cancellation policies.
                                    </span>
                                </label>
                            </div>
                        </section>
                    </div>

                    <aside class="sidebar">
                        <div class="sidebar-card">
                            <span class="pill">Submit Registration</span>

                            <h2>Ready to continue?</h2>

                            <p>
                                After submitting this form, your registration number will be created and you will be directed to the payment page.
                            </p>

                            <button type="submit" class="button button-blue">
                                Submit Registration
                            </button>
                        </div>

                        <div class="sidebar-card">
                            <span class="pill">Need Help?</span>

                            <h2>Contact our team</h2>

                            <p>
                                If you are unsure which pricing category to choose, contact the Reframing team before submitting.
                            </p>

                            <a href="https://api.whatsapp.com/send?phone=628889637876" class="button button-outline">
                                Contact Reframing Team
                            </a>
                        </div>
                    </aside>
                </form>
            </div>
        </section>
    </main>
</body>
</html>