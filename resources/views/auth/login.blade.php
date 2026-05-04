<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Login - Reframing Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy: #123a56;
            --blue: #1d6f99;
            --orange: #fb5607;
            --text: #123047;
            --muted: #718096;
            --line: #e6edf3;
            --soft: #f7fbfd;
            --danger: #dc2626;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(29, 111, 153, 0.14), transparent 30%),
                radial-gradient(circle at bottom right, rgba(18, 58, 86, 0.10), transparent 28%),
                linear-gradient(180deg, #ffffff 0%, #f8fbfd 100%);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .page {
            width: min(100% - 40px, 1180px);
            min-height: 100vh;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 0;
        }

        .shell {
            width: 100%;
            display: grid;
            grid-template-columns: 0.95fr 1.05fr;
            gap: 34px;
            align-items: stretch;
        }

        .intro,
        .card {
            border-radius: 34px;
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.88);
            box-shadow: 0 28px 80px rgba(18, 58, 86, 0.08);
            overflow: hidden;
        }

        .intro {
            position: relative;
            padding: 42px;
            background:
                linear-gradient(160deg, rgba(18, 58, 86, 0.96), rgba(29, 111, 153, 0.88));
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 620px;
        }

        .intro::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(rgba(255,255,255,0.045) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.045) 1px, transparent 1px);
            background-size: 42px 42px;
            opacity: 0.75;
        }

        .intro > * {
            position: relative;
            z-index: 1;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .logo {
            width: 58px;
            height: 58px;
            border-radius: 999px;
            background: white;
            border: 1px solid rgba(255,255,255,0.28);
            overflow: hidden;
            flex: 0 0 auto;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .brand-kicker {
            margin: 0;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.72);
        }

        .brand-title {
            margin: 3px 0 0;
            font-size: 24px;
            line-height: 1;
            font-weight: 950;
            letter-spacing: -0.5px;
        }

        .pill {
            display: inline-flex;
            width: fit-content;
            padding: 9px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.16);
            color: rgba(255,255,255,0.9);
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .intro-title {
            margin: 24px 0 0;
            max-width: 560px;
            font-size: clamp(42px, 5vw, 66px);
            line-height: 0.98;
            letter-spacing: -2.5px;
            font-weight: 950;
        }

        .intro-text {
            margin: 20px 0 0;
            max-width: 560px;
            color: rgba(255,255,255,0.78);
            font-size: 16px;
            line-height: 1.75;
        }

        .steps {
            display: grid;
            gap: 12px;
        }

        .step {
            display: grid;
            grid-template-columns: 38px 1fr;
            gap: 12px;
            align-items: start;
            border-radius: 22px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.14);
            padding: 16px;
        }

        .step-number {
            width: 38px;
            height: 38px;
            border-radius: 999px;
            background: white;
            color: var(--navy);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 950;
        }

        .step strong {
            display: block;
            font-size: 14px;
            color: white;
        }

        .step span {
            display: block;
            margin-top: 4px;
            color: rgba(255,255,255,0.72);
            font-size: 13px;
            line-height: 1.45;
        }

        .card {
            padding: 44px;
            display: flex;
            align-items: center;
        }

        .form-wrap {
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
        }

        .mobile-brand {
            display: none;
            align-items: center;
            gap: 12px;
            margin-bottom: 26px;
        }

        .mobile-brand .logo {
            width: 48px;
            height: 48px;
            border: 1px solid #d7ecf5;
        }

        .mobile-brand .brand-kicker {
            color: var(--blue);
        }

        .mobile-brand .brand-title {
            color: var(--navy);
            font-size: 20px;
        }

        .form-kicker {
            margin: 0;
            color: var(--blue);
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .form-title {
            margin: 10px 0 0;
            color: var(--navy);
            font-size: clamp(34px, 4vw, 46px);
            line-height: 1.05;
            letter-spacing: -1.8px;
            font-weight: 950;
        }

        .form-text {
            margin: 14px 0 0;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.7;
        }

        .form {
            margin-top: 28px;
            display: grid;
            gap: 18px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            color: var(--navy);
            font-size: 13px;
            font-weight: 900;
        }

        .field input {
            width: 100%;
            min-height: 54px;
            border-radius: 18px;
            border: 1px solid var(--line);
            background: var(--soft);
            padding: 0 16px;
            color: var(--text);
            font: inherit;
            outline: none;
            transition: 0.2s ease;
        }

        .field input:focus {
            border-color: #9ed7ec;
            box-shadow: 0 0 0 4px rgba(29, 111, 153, 0.11);
            background: white;
        }

        .error {
            margin-top: 8px;
            color: var(--danger);
            font-size: 13px;
            font-weight: 800;
        }

        .status-message {
            margin-top: 18px;
            border-radius: 18px;
            background: #edf7fb;
            border: 1px solid #d9edf6;
            padding: 14px;
            color: var(--blue);
            font-size: 14px;
            font-weight: 800;
        }

        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        .remember {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 14px;
            font-weight: 800;
        }

        .remember input {
            width: 16px;
            height: 16px;
        }

        .link {
            color: var(--blue);
            font-size: 14px;
            font-weight: 900;
        }

        .button {
            width: 100%;
            min-height: 56px;
            border: 0;
            border-radius: 999px;
            background: var(--navy);
            color: white;
            font-size: 15px;
            font-weight: 950;
            cursor: pointer;
            box-shadow: 0 16px 34px rgba(18, 58, 86, 0.16);
            transition: 0.2s ease;
        }

        .button:hover {
            background: var(--blue);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 26px 0;
            color: var(--muted);
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--line);
        }

        .actions {
            display: grid;
            gap: 12px;
        }

        .outline-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 52px;
            border-radius: 999px;
            border: 1px solid var(--line);
            background: white;
            color: var(--navy);
            font-size: 14px;
            font-weight: 950;
            transition: 0.2s ease;
        }

        .outline-button:hover {
            background: var(--soft);
            border-color: #c8d8e2;
        }

        @media (max-width: 980px) {
            .page {
                width: min(100% - 28px, 680px);
            }

            .shell {
                grid-template-columns: 1fr;
            }

            .intro {
                display: none;
            }

            .mobile-brand {
                display: flex;
            }

            .card {
                padding: 32px;
            }
        }

        @media (max-width: 540px) {
            .page {
                width: min(100% - 22px, 680px);
                padding: 28px 0;
            }

            .card {
                border-radius: 26px;
                padding: 24px;
            }

            .form-title {
                letter-spacing: -1.2px;
            }

            .row {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <main class="page">
        <div class="shell">
            <section class="intro">
                <a href="{{ route('public.programs.index') }}" class="brand">
                    <div class="logo">
                        <img src="https://reframingphysio.com/wp-content/uploads/2026/02/cropped-FAVICON.png" alt="Reframing Academy">
                    </div>
                    <div>
                        <p class="brand-kicker">Reframing Academy</p>
                        <p class="brand-title">Participant Portal</p>
                    </div>
                </a>

                <div>
                    <span class="pill">Participant Access</span>
                    <h1 class="intro-title">Continue your certification journey.</h1>
                    <p class="intro-text">
                        Login to track your registration, submit payment proof, upload documents,
                        and download your certificate once issued.
                    </p>
                </div>

                <div class="steps">
                    <div class="step">
                        <div class="step-number">1</div>
                        <div>
                            <strong>Track registration</strong>
                            <span>See payment, registration, and document review status.</span>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <div>
                            <strong>Upload documents</strong>
                            <span>Submit supporting files and revisions from your dashboard.</span>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <div>
                            <strong>Download certificate</strong>
                            <span>Access your certificate PDF once the admin team uploads it.</span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="card">
                <div class="form-wrap">
                    <a href="{{ route('public.programs.index') }}" class="mobile-brand">
                        <div class="logo">
                            <img src="https://reframingphysio.com/wp-content/uploads/2026/02/cropped-FAVICON.png" alt="Reframing Academy">
                        </div>
                        <div>
                            <p class="brand-kicker">Reframing Academy</p>
                            <p class="brand-title">Participant Portal</p>
                        </div>
                    </a>

                    <p class="form-kicker">Welcome Back</p>
                    <h1 class="form-title">Login to your dashboard</h1>
                    <p class="form-text">
                        Use the same email address you used during program registration.
                    </p>

                    @if (session('status'))
                        <div class="status-message">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="form">
                        @csrf

                        <div class="field">
                            <label for="email">Email address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <label class="remember">
                                <input type="checkbox" name="remember">
                                <span>Remember me</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="link">Forgot password?</a>
                            @endif
                        </div>

                        <button type="submit" class="button">Login</button>
                    </form>

                    <div class="divider">New participant?</div>

                    <div class="actions">
                        <a href="{{ route('register') }}" class="outline-button">
                            Create participant account
                        </a>

                        <a href="{{ route('public.programs.index') }}" class="outline-button">
                            Browse certification programs
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
