<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Dashboard - Reframing Academy</title>
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

        * {
            box-sizing: border-box;
        }

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
            min-width: 46px;
            border-radius: 999px;
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

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-name {
            color: var(--muted);
            font-size: 14px;
            font-weight: 750;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 18px;
            border-radius: 999px;
            border: 1px solid transparent;
            font-size: 14px;
            font-weight: 900;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .button-navy {
            background: var(--navy);
            color: white;
            box-shadow: 0 10px 24px rgba(18, 58, 86, 0.14);
        }

        .button-navy:hover {
            background: var(--blue);
        }

        .button-blue {
            background: var(--blue);
            color: white;
            box-shadow: 0 16px 36px rgba(29, 111, 153, 0.20);
        }

        .button-blue:hover {
            background: var(--navy);
        }

        .button-white {
            background: white;
            color: var(--navy);
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

        .page {
            background:
                radial-gradient(circle at top right, rgba(29, 111, 153, 0.10), transparent 34%),
                linear-gradient(180deg, #ffffff 0%, #f8fbfd 100%);
            min-height: calc(100vh - 82px);
            padding: 56px 0 88px;
        }

        .hero-card {
            overflow: hidden;
            border-radius: 34px;
            background: white;
            border: 1px solid var(--line);
            box-shadow: 0 22px 60px rgba(18, 58, 86, 0.07);
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
        }

        .hero-main {
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
            font-size: clamp(36px, 4.8vw, 58px);
            line-height: 1.04;
            letter-spacing: -2.2px;
            font-weight: 950;
        }

        .hero-text {
            margin: 18px 0 0;
            max-width: 840px;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.75;
        }

        .hero-side {
            background:
                radial-gradient(circle at top right, rgba(255,255,255,0.18), transparent 30%),
                linear-gradient(160deg, #1d6f99, #123a56);
            color: white;
            padding: 42px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .side-label {
            margin: 0;
            color: rgba(255,255,255,0.72);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .side-email {
            margin: 10px 0 0;
            color: white;
            font-size: 24px;
            font-weight: 950;
            line-height: 1.25;
            word-break: break-word;
        }

        .side-note {
            margin: 20px 0 0;
            border-radius: 24px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.14);
            padding: 18px;
            color: rgba(255,255,255,0.82);
            font-size: 14px;
            line-height: 1.7;
        }

        .section {
            margin-top: 54px;
        }

        .section-head {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 24px;
        }

        .section-kicker {
            margin: 0;
            color: var(--blue);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1.4px;
        }

        .section-title {
            margin: 10px 0 0;
            color: var(--navy);
            font-size: clamp(30px, 3vw, 42px);
            line-height: 1.1;
            letter-spacing: -1.4px;
            font-weight: 950;
        }

        .section-description {
            margin: 0;
            max-width: 560px;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.7;
        }

        .empty-card {
            border-radius: 34px;
            background: white;
            border: 1px solid var(--line);
            box-shadow: 0 18px 55px rgba(18, 58, 86, 0.06);
            padding: 44px;
            text-align: center;
        }

        .empty-card h3 {
            margin: 22px 0 0;
            color: var(--navy);
            font-size: 34px;
            line-height: 1.1;
            letter-spacing: -1.2px;
            font-weight: 950;
        }

        .empty-card p {
            margin: 16px auto 0;
            max-width: 720px;
            color: var(--muted);
            line-height: 1.75;
        }

        .program-list {
            display: grid;
            gap: 22px;
        }

        .program-card {
            overflow: hidden;
            border-radius: 34px;
            background: white;
            border: 1px solid var(--line);
            box-shadow: 0 18px 55px rgba(18, 58, 86, 0.06);
        }

        .program-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
        }

        .program-main {
            padding: 34px;
        }

        .badges {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .badge {
            display: inline-flex;
            border-radius: 999px;
            border: 1px solid var(--line);
            background: var(--soft);
            padding: 7px 12px;
            color: var(--navy);
            font-size: 12px;
            font-weight: 900;
        }

        .badge-blue {
            background: var(--blue-soft);
            color: var(--blue);
            border-color: #d9edf6;
        }

        .badge-green {
            background: var(--green-soft);
            color: var(--green);
            border-color: #bbf7d0;
        }

        .badge-orange {
            background: var(--orange-soft);
            color: var(--orange);
            border-color: #fed7aa;
        }

        .program-title {
            margin: 20px 0 0;
            color: var(--navy);
            font-size: clamp(26px, 3vw, 38px);
            line-height: 1.1;
            letter-spacing: -1.3px;
            font-weight: 950;
        }

        .program-meta {
            margin: 12px 0 0;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.6;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-top: 26px;
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

        .status-green {
            color: var(--green) !important;
        }

        .status-orange {
            color: var(--orange) !important;
        }

        .document-box {
            margin-top: 14px;
            border-radius: 22px;
            background: var(--soft);
            border: 1px solid var(--line);
            padding: 20px;
        }

        .document-box span {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.9px;
        }

        .document-box strong {
            display: block;
            margin-top: 8px;
            color: var(--navy);
            font-size: 16px;
            text-transform: uppercase;
        }

        .certificate-box {
            margin-top: 14px;
            border-radius: 22px;
            background: var(--green-soft);
            border: 1px solid #bbf7d0;
            padding: 20px;
            color: var(--green);
        }

        .certificate-box span {
            display: block;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.9px;
        }

        .certificate-box strong {
            display: block;
            margin-top: 8px;
            font-size: 16px;
        }

        .download-document-card {
            margin-top: 16px;
            border-radius: 24px;
            background: var(--blue-soft);
            border: 1px solid #d9edf6;
            padding: 22px;
        }

        .download-document-card h4 {
            margin: 0;
            color: var(--navy);
            font-size: 20px;
            line-height: 1.2;
            letter-spacing: -0.5px;
            font-weight: 950;
        }

        .download-document-card p {
            margin: 8px 0 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .download-document-card .button {
            margin-top: 16px;
        }

        .document-upload-card {
            margin-top: 16px;
            border-radius: 24px;
            background: white;
            border: 1px solid var(--line);
            padding: 22px;
        }

        .document-upload-card h4 {
            margin: 0;
            color: var(--navy);
            font-size: 20px;
            line-height: 1.2;
            letter-spacing: -0.5px;
            font-weight: 950;
        }

        .document-upload-card p {
            margin: 8px 0 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .document-form {
            display: grid;
            gap: 12px;
            margin-top: 18px;
        }

        .document-form select,
        .document-form input[type="file"] {
            width: 100%;
            min-height: 46px;
            border-radius: 16px;
            border: 1px solid var(--line);
            background: var(--soft);
            color: var(--text);
            padding: 11px 14px;
            font: inherit;
            outline: none;
        }

        .document-form select {
            appearance: none;
            -webkit-appearance: none;
            background-image:
                linear-gradient(45deg, transparent 50%, var(--navy) 50%),
                linear-gradient(135deg, var(--navy) 50%, transparent 50%);
            background-position:
                calc(100% - 24px) 50%,
                calc(100% - 17px) 50%;
            background-size:
                7px 7px,
                7px 7px;
            background-repeat: no-repeat;
            padding-right: 52px;
            cursor: pointer;
        }

        .document-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            border: 0;
            border-radius: 999px;
            background: var(--blue);
            color: white;
            padding: 0 18px;
            font-size: 14px;
            font-weight: 900;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .document-submit:hover {
            background: var(--navy);
        }

        .uploaded-documents {
            display: grid;
            gap: 10px;
            margin-top: 18px;
        }

        .uploaded-document {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 12px;
            align-items: center;
            border-radius: 18px;
            background: var(--soft);
            border: 1px solid var(--line);
            padding: 14px;
        }

        .uploaded-document strong {
            display: block;
            color: var(--navy);
            font-size: 14px;
            font-weight: 950;
        }

        .uploaded-document span {
            display: block;
            margin-top: 4px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .uploaded-document a {
            color: var(--blue);
            font-size: 13px;
            font-weight: 950;
        }

        .program-side {
            background:
                radial-gradient(circle at top right, rgba(255,255,255,0.18), transparent 30%),
                linear-gradient(160deg, #1d6f99, #123a56);
            color: white;
            padding: 34px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .program-side h4 {
            margin: 14px 0 0;
            color: white;
            font-size: 26px;
            line-height: 1.1;
            letter-spacing: -0.9px;
            font-weight: 950;
        }

        .program-side p {
            margin: 14px 0 0;
            color: rgba(255,255,255,0.82);
            font-size: 14px;
            line-height: 1.7;
        }

        .side-actions {
            display: grid;
            gap: 12px;
            margin-top: 28px;
        }

        .logout-form {
            margin: 0;
        }

        .logout-button {
            background: transparent;
            color: var(--muted);
            border: none;
            padding: 0;
            font: inherit;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
        }

        .logout-button:hover {
            color: var(--navy);
        }

        @media (max-width: 1180px) {
            .hero-grid,
            .program-grid {
                grid-template-columns: 1fr;
            }

            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .section-head {
                align-items: start;
                flex-direction: column;
            }
        }

        @media (max-width: 720px) {
            .container {
                width: min(100% - 28px, 1600px);
            }

            .navbar-inner {
                min-height: 72px;
            }

            .brand-mark {
                width: 40px;
                height: 40px;
                min-width: 40px;
            }

            .brand-title {
                font-size: 17px;
            }

            .user-name {
                display: none;
            }

            .hero-main,
            .hero-side,
            .program-main,
            .program-side,
            .empty-card {
                padding: 24px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .hero-title {
                letter-spacing: -1.6px;
            }

            .button {
                width: 100%;
            }

            .nav-actions {
                gap: 8px;
            }
        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="container navbar-inner">
            <a href="{{ route('dashboard') }}" class="brand">
                <div class="brand-mark">
                    <img src="https://reframingphysio.com/wp-content/uploads/2026/02/cropped-FAVICON.png" alt="Reframing Physio">
                </div>

                <div>
                    <p class="brand-kicker">Reframing Academy</p>
                    <p class="brand-title">Participant Dashboard</p>
                </div>
            </a>

            <div class="nav-actions">
                <span class="user-name">{{ auth()->user()->name }}</span>

                <a href="{{ route('public.programs.index') }}" class="button button-navy">
                    Browse Programs
                </a>

                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-button">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="page">
        <div class="container">
            <section class="hero-card">
                <div class="hero-grid">
                    <div class="hero-main">
                        <span class="pill">Welcome Back</span>

                        <h1 class="hero-title">
                            Hello, {{ auth()->user()->name }}
                        </h1>

                        <p class="hero-text">
                            This dashboard shows your Reframing Academy registrations based on your login email.
                            You can track your program, payment status, registration status, document status,
                            and certificate information here.
                        </p>
                    </div>

                    <aside class="hero-side">
                        <div>
                            <p class="side-label">Account Email</p>
                            <p class="side-email">{{ auth()->user()->email }}</p>

                            <div class="side-note">
                                Registrations are matched automatically using this email address.
                                If you registered with a different email, please contact the Reframing team.
                            </div>
                        </div>
                    </aside>
                </div>
            </section>

            <section class="section">
                <div class="section-head">
                    <div>
                        <p class="section-kicker">My Programs</p>
                        <h2 class="section-title">Your registered certification programs</h2>
                    </div>

                    <p class="section-description">
                        Showing registrations linked to {{ auth()->user()->email }}.
                    </p>
                </div>

                @if ($registrations->isEmpty())
                    <div class="empty-card">
                        <span class="pill">No Registration Found</span>

                        <h3>You do not have any registered programs yet.</h3>

                        <p>
                            There are no registrations connected to this email account.
                            Browse available certification programs and complete your registration.
                        </p>

                        <div style="margin-top: 28px;">
                            <a href="{{ route('public.programs.index') }}" class="button button-blue">
                                Browse Programs
                            </a>
                        </div>
                    </div>
                @else
                    <div class="program-list">
                        @foreach ($registrations as $registration)
                            <article class="program-card">
                                <div class="program-grid">
                                    <div class="program-main">
                                        <div class="badges">
                                            <span class="badge badge-blue">{{ $registration->program->code }}</span>
                                            <span class="badge">{{ $registration->registration_number }}</span>

                                            @if ($registration->payment_status === 'paid')
                                                <span class="badge badge-green">Payment Paid</span>
                                            @else
                                                <span class="badge badge-orange">Payment {{ $registration->payment_status }}</span>
                                            @endif
                                        </div>

                                        <h3 class="program-title">{{ $registration->batch->title }}</h3>

                                        <p class="program-meta">
                                            {{ $registration->batch->start_date->format('d M Y') }}
                                            -
                                            {{ $registration->batch->end_date->format('d M Y') }}
                                            · {{ $registration->batch->location }}
                                        </p>

                                        <div class="info-grid">
                                            <div class="info-box">
                                                <span>Pricing Category</span>
                                                <strong>{{ $registration->price->label }}</strong>
                                            </div>

                                            <div class="info-box">
                                                <span>Total Payment</span>
                                                <strong>Rp{{ number_format($registration->total_amount, 0, ',', '.') }}</strong>
                                            </div>

                                            <div class="info-box">
                                                <span>Payment</span>
                                                <strong class="{{ $registration->payment_status === 'paid' ? 'status-green' : 'status-orange' }}">
                                                    {{ strtoupper($registration->payment_status) }}
                                                </strong>
                                            </div>

                                            <div class="info-box">
                                                <span>Registration</span>
                                                <strong class="{{ $registration->registration_status === 'confirmed' ? 'status-green' : 'status-orange' }}">
                                                    {{ strtoupper($registration->registration_status) }}
                                                </strong>
                                            </div>
                                        </div>

                                        <div class="document-box">
                                            <span>Document Status</span>
                                            <strong>{{ str_replace('_', ' ', $registration->document_status) }}</strong>
                                        </div>

                                        <div class="download-document-card">
                                            <h4>Surat Perizinan Cuti / LOA</h4>

                                            @if ($registration->payment_status === 'paid')
                                                <p>
                                                    Generate surat perizinan cuti/LOA dalam format PDF resmi yang tidak dapat diedit bebas.
                                                    Isi data tujuan surat, lalu sistem akan membuat PDF otomatis.
                                                </p>

                                                <a href="{{ route('participant.loa.create', $registration) }}" class="button button-blue">
                                                    Generate LOA PDF
                                                </a>
                                            @else
                                                <p>
                                                    LOA tersedia setelah pembayaran disetujui oleh admin.
                                                    Silakan selesaikan pembayaran terlebih dahulu.
                                                </p>

                                                <a href="{{ route('public.payments.show', $registration->registration_number) }}" class="button button-outline">
                                                    Complete Payment First
                                                </a>
                                            @endif
                                        </div>

                                        <div class="document-upload-card">
                                            <h4>Upload Supporting Documents</h4>
                                            <p>
                                                Upload required documents such as identity card, professional license,
                                                certificate, or other supporting documents. Accepted formats: JPG, PNG, or PDF.
                                            </p>

                                            @if ($registration->documents->isNotEmpty())
                                                <div class="uploaded-documents">
                                                    @foreach ($registration->documents as $document)
                                                        <div class="uploaded-document">
                                                            <div>
                                                                <strong>{{ strtoupper(str_replace('_', ' ', $document->document_type)) }}</strong>
                                                                <span>Status: {{ strtoupper(str_replace('_', ' ', $document->status)) }}</span>
                                                            </div>

                                                            <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">
                                                                View
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <form
                                                method="POST"
                                                action="{{ route('participant.documents.store', $registration) }}"
                                                enctype="multipart/form-data"
                                                class="document-form"
                                            >
                                                @csrf

                                                <select name="document_type" required>
                                                    <option value="">Select document type</option>
                                                    <option value="identity_document">Identity Document / KTP / Passport</option>
                                                    <option value="professional_license">Professional License / STR / SIP</option>
                                                    <option value="certificate_or_skp">Certificate / SKP / Supporting Certificate</option>
                                                    <option value="alumni_or_member_proof">Alumni / Member Proof</option>
                                                    <option value="other_document">Other Document</option>
                                                </select>

                                                <input type="file" name="document_file" accept=".jpg,.jpeg,.png,.pdf" required>

                                                <button type="submit" class="document-submit">
                                                    Upload Document
                                                </button>
                                            </form>
                                        </div>

                                        @if ($registration->certificate)
                                            <div class="certificate-box">
                                                <span>Certificate</span>
                                                <strong>{{ $registration->certificate->certificate_number }}</strong>
                                                <div style="margin-top: 4px; font-size: 14px; font-weight: 800;">
                                                    Status: {{ strtoupper($registration->certificate->status) }}
                                                </div>

                                                @if ($registration->certificate->file_path)
                                                    <div style="margin-top: 14px;">
                                                        <a
                                                            href="{{ asset('storage/' . $registration->certificate->file_path) }}"
                                                            target="_blank"
                                                            class="button button-blue"
                                                        >
                                                            Download Certificate
                                                        </a>
                                                    </div>
                                                @else
                                                    <div style="margin-top: 12px; font-size: 14px; font-weight: 800; line-height: 1.6;">
                                                        Certificate file is being prepared by our admin team.
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>

                                    <aside class="program-side">
                                        <div>
                                            <p class="side-label">Next Action</p>

                                            @if ($registration->payment_status !== 'paid')
                                                <h4>Complete your payment</h4>
                                                <p>
                                                    Continue to the payment page to complete your registration.
                                                </p>
                                            @else
                                                <h4>Payment completed</h4>
                                                <p>
                                                    Your registration has been confirmed. You can review your payment summary anytime.
                                                </p>
                                            @endif
                                        </div>

                                        <div class="side-actions">
                                            <a href="{{ route('public.payments.show', $registration) }}" class="button button-white">
                                                {{ $registration->payment_status !== 'paid' ? 'Continue Payment' : 'View Payment' }}
                                            </a>

                                            <a href="{{ route('public.programs.show', $registration->batch) }}" class="button button-outline">
                                                View Program Detail
                                            </a>
                                        </div>
                                    </aside>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>
        </div>
    </main>
</body>
</html>