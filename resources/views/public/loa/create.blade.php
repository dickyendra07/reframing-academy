<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate LOA - Reframing Academy</title>
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
            background:
                radial-gradient(circle at top right, rgba(29, 111, 153, 0.10), transparent 34%),
                linear-gradient(180deg, #ffffff 0%, #f8fbfd 100%);
            color: var(--text);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            min-height: 100vh;
        }

        a { color: inherit; text-decoration: none; }

        .container {
            width: min(1080px, calc(100% - 48px));
            margin: 0 auto;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255,255,255,0.94);
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

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0 20px;
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
            box-shadow: 0 12px 30px rgba(18, 58, 86, 0.15);
        }

        .button-navy:hover { background: var(--blue); }

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
            padding: 58px 0 88px;
        }

        .card {
            overflow: hidden;
            border-radius: 36px;
            background: white;
            border: 1px solid var(--line);
            box-shadow: 0 24px 80px rgba(18, 58, 86, 0.10);
        }

        .hero {
            padding: 40px;
            background:
                radial-gradient(circle at top right, rgba(255,255,255,0.16), transparent 30%),
                linear-gradient(160deg, #1d6f99, #123a56);
            color: white;
        }

        .pill {
            display: inline-flex;
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
            margin: 20px 0 0;
            max-width: 760px;
            color: white;
            font-size: clamp(34px, 4vw, 54px);
            line-height: 1.06;
            letter-spacing: -2px;
            font-weight: 950;
        }

        .text {
            margin: 16px 0 0;
            max-width: 760px;
            color: rgba(255,255,255,0.84);
            font-size: 16px;
            line-height: 1.8;
        }

        .content {
            padding: 38px 40px 42px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 28px;
        }

        .summary-box {
            border-radius: 22px;
            background: var(--soft);
            border: 1px solid var(--line);
            padding: 20px;
        }

        .summary-box span {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.9px;
        }

        .summary-box strong {
            display: block;
            margin-top: 8px;
            color: var(--navy);
            font-size: 15px;
            line-height: 1.4;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        .field-full {
            grid-column: 1 / -1;
        }

        label {
            color: var(--navy);
            font-size: 14px;
            font-weight: 850;
        }

        input,
        textarea {
            width: 100%;
            border: 1px solid #d7e2ea;
            border-radius: 16px;
            background: white;
            color: var(--text);
            padding: 14px 15px;
            font-size: 15px;
            font: inherit;
            outline: none;
            transition: 0.2s ease;
        }

        input {
            min-height: 50px;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(29, 111, 153, 0.10);
        }

        .hint {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
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

        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 28px;
        }

        @media (max-width: 820px) {
            .summary-grid,
            .form-grid {
                grid-template-columns: 1fr;
            }

            .hero,
            .content {
                padding: 26px;
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
            <a href="{{ route('dashboard') }}" class="brand">
                <div class="brand-mark">
                    <img src="https://reframingphysio.com/wp-content/uploads/2026/02/cropped-FAVICON.png" alt="Reframing Physio">
                </div>

                <div>
                    <p class="brand-kicker">Reframing Academy</p>
                    <p class="brand-title">Generate LOA</p>
                </div>
            </a>

            <a href="{{ route('dashboard') }}" class="button button-outline">
                Back to Dashboard
            </a>
        </div>
    </header>

    <main class="page">
        <div class="container">
            <section class="card">
                <div class="hero">
                    <span class="pill">Letter of Assignment</span>

                    <h1 class="title">
                        Generate official LOA PDF
                    </h1>

                    <p class="text">
                        Complete the information below to generate a non-editable PDF letter for your company or institution.
                    </p>
                </div>

                <div class="content">
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

                    <div class="summary-grid">
                        <div class="summary-box">
                            <span>Registration</span>
                            <strong>{{ $registration->registration_number }}</strong>
                        </div>

                        <div class="summary-box">
                            <span>Participant</span>
                            <strong>{{ $registration->full_name }}</strong>
                        </div>

                        <div class="summary-box">
                            <span>Program</span>
                            <strong>{{ $registration->batch->title }}</strong>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('participant.loa.download', $registration) }}">
                        @csrf

                        <div class="form-grid">
                            <div class="field">
                                <label for="company_name">Company / Institution Name *</label>
                                <input id="company_name" type="text" name="company_name" value="{{ old('company_name', $registration->institution) }}" required>
                                <div class="hint">Example: RS Sehat Sentosa / Klinik Fisioterapi Mandiri.</div>
                            </div>

                            <div class="field">
                                <label for="letter_city">Letter City</label>
                                <input id="letter_city" type="text" name="letter_city" value="{{ old('letter_city', $registration->city) }}" placeholder="Example: Jakarta">
                            </div>

                            <div class="field">
                                <label for="recipient_name">Recipient Name</label>
                                <input id="recipient_name" type="text" name="recipient_name" value="{{ old('recipient_name') }}" placeholder="Optional">
                            </div>

                            <div class="field">
                                <label for="recipient_position">Recipient Position</label>
                                <input id="recipient_position" type="text" name="recipient_position" value="{{ old('recipient_position') }}" placeholder="HRD / Manager / Director">
                            </div>

                            <div class="field">
                                <label for="leave_start_date">Leave Start Date *</label>
                                <input id="leave_start_date" type="date" name="leave_start_date" value="{{ old('leave_start_date', $registration->batch->start_date->format('Y-m-d')) }}" required>
                            </div>

                            <div class="field">
                                <label for="leave_end_date">Leave End Date *</label>
                                <input id="leave_end_date" type="date" name="leave_end_date" value="{{ old('leave_end_date', $registration->batch->end_date->format('Y-m-d')) }}" required>
                            </div>

                            <div class="field field-full">
                                <label for="notes">Additional Notes</label>
                                <textarea id="notes" name="notes" placeholder="Optional notes for the letter.">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <div class="actions">
                            <button type="submit" class="button button-navy">
                                Generate LOA PDF
                            </button>

                            <a href="{{ route('dashboard') }}" class="button button-outline">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
