<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - {{ $registration->registration_number }} - Reframing Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy: #123a56;
            --blue: #1d6f99;
            --blue-soft: #edf7fb;
            --orange: #f35b04;
            --orange-dark: #c2410c;
            --green: #15803d;
            --green-soft: #ecfdf5;
            --yellow: #a16207;
            --yellow-soft: #fefce8;
            --text: #102033;
            --muted: #6b7280;
            --line: #e7edf2;
            --soft: #f8fbfd;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background:
                radial-gradient(circle at top right, rgba(29, 111, 153, 0.10), transparent 32%),
                linear-gradient(180deg, #ffffff 0%, #f8fbfd 100%);
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
            backdrop-filter: blur(16px);
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

        .brand-logo {
            width: 46px;
            height: 46px;
            min-width: 46px;
            border-radius: 999px;
            overflow: hidden;
            border: 1px solid #d8ecf5;
            background: white;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .brand-kicker {
            margin: 0;
            color: var(--blue);
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        .brand-title {
            margin: 2px 0 0;
            color: var(--navy);
            font-size: 20px;
            line-height: 1;
            font-weight: 950;
            letter-spacing: -0.4px;
        }

        .nav-link {
            display: inline-flex;
            min-height: 44px;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            border: 1px solid var(--line);
            background: white;
            padding: 0 18px;
            color: var(--navy);
            font-size: 14px;
            font-weight: 900;
            transition: 0.2s ease;
        }

        .nav-link:hover {
            border-color: #c8d8e2;
            background: var(--soft);
        }

        .page {
            padding: 54px 0 90px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 460px;
            gap: 28px;
            align-items: start;
        }

        .card {
            overflow: hidden;
            border-radius: 34px;
            border: 1px solid var(--line);
            background: var(--white);
            box-shadow: 0 22px 60px rgba(18, 58, 86, 0.07);
        }

        .card-body {
            padding: 38px;
        }

        .hero {
            background:
                radial-gradient(circle at top right, rgba(255, 255, 255, 0.16), transparent 28%),
                linear-gradient(160deg, #1d6f99, #123a56);
            color: white;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            border: 1px solid #d9edf6;
            background: var(--blue-soft);
            padding: 8px 13px;
            color: var(--blue);
            font-size: 12px;
            font-weight: 950;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .hero .pill {
            border-color: rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.12);
            color: white;
        }

        .title {
            margin: 20px 0 0;
            color: var(--navy);
            font-size: clamp(34px, 4vw, 54px);
            line-height: 1.05;
            letter-spacing: -2px;
            font-weight: 950;
        }

        .hero .title {
            color: white;
        }

        .text {
            margin: 16px 0 0;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.75;
        }

        .hero .text {
            color: rgba(255,255,255,0.82);
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            margin-top: 28px;
        }

        .summary-box {
            border-radius: 22px;
            border: 1px solid rgba(255,255,255,0.14);
            background: rgba(255,255,255,0.10);
            padding: 18px;
        }

        .summary-box span {
            display: block;
            color: rgba(255,255,255,0.68);
            font-size: 11px;
            font-weight: 950;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .summary-box strong {
            display: block;
            margin-top: 8px;
            color: white;
            font-size: 17px;
            line-height: 1.35;
        }

        .section-title {
            margin: 0;
            color: var(--navy);
            font-size: 26px;
            line-height: 1.15;
            letter-spacing: -0.8px;
            font-weight: 950;
        }

        .bank-box {
            margin-top: 22px;
            border-radius: 28px;
            border: 1px solid var(--line);
            background: var(--soft);
            padding: 24px;
        }

        .bank-row {
            display: grid;
            grid-template-columns: 160px 1fr auto;
            align-items: center;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid var(--line);
        }

        .bank-row:last-child {
            border-bottom: 0;
        }

        .bank-row span {
            color: var(--muted);
            font-size: 13px;
            font-weight: 850;
        }

        .bank-row strong {
            color: var(--navy);
            font-size: 15px;
            font-weight: 950;
        }

        .copy-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 34px;
            border: 1px solid #d9edf6;
            border-radius: 999px;
            background: var(--blue-soft);
            color: var(--blue);
            padding: 0 12px;
            font-size: 12px;
            font-weight: 950;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .copy-button:hover {
            background: #dff1f8;
            border-color: #b9dfef;
        }

        .copy-button.copied {
            background: var(--green-soft);
            color: var(--green);
            border-color: #bbf7d0;
        }

        .status {
            display: inline-flex;
            border-radius: 999px;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 950;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .status-paid {
            background: var(--green-soft);
            color: var(--green);
            border: 1px solid #bbf7d0;
        }

        .status-review {
            background: var(--yellow-soft);
            color: var(--yellow);
            border: 1px solid #fde68a;
        }

        .status-unpaid {
            background: #fff7ed;
            color: var(--orange-dark);
            border: 1px solid #fed7aa;
        }

        .alert {
            margin-bottom: 22px;
            border-radius: 24px;
            border: 1px solid #bbf7d0;
            background: var(--green-soft);
            padding: 18px;
            color: var(--green);
            font-size: 14px;
            font-weight: 850;
            line-height: 1.6;
        }

        .error-box {
            margin-bottom: 22px;
            border-radius: 24px;
            border: 1px solid #fecaca;
            background: #fef2f2;
            padding: 18px;
            color: #b91c1c;
            font-size: 14px;
            line-height: 1.7;
        }

        .form {
            display: grid;
            gap: 18px;
            margin-top: 24px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            color: var(--navy);
            font-size: 13px;
            font-weight: 950;
        }

        .field select,
        .field textarea,
        .field input[type="file"] {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: white;
            padding: 14px 15px;
            color: var(--text);
            font: inherit;
            outline: none;
        }

        .field select {
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

        .field select:focus {
            border-color: #9ed7ec;
            box-shadow: 0 0 0 4px rgba(29, 111, 153, 0.10);
        }

        .field textarea {
            min-height: 110px;
            resize: vertical;
        }

        .help {
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 54px;
            border-radius: 18px;
            border: 0;
            background: var(--orange);
            color: white;
            font-size: 15px;
            font-weight: 950;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .button:hover {
            background: var(--orange-dark);
        }

        .button-secondary {
            margin-top: 12px;
            background: var(--navy);
        }

        .button-secondary:hover {
            background: var(--blue);
        }

        .proof-link {
            display: inline-flex;
            margin-top: 14px;
            color: var(--blue);
            font-size: 14px;
            font-weight: 950;
        }

        .note {
            margin-top: 18px;
            border-radius: 22px;
            border: 1px solid var(--line);
            background: var(--soft);
            padding: 18px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        @media (max-width: 1100px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 720px) {
            .container {
                width: min(100% - 28px, 1600px);
            }

            .navbar-inner {
                min-height: 74px;
            }

            .brand-logo {
                width: 40px;
                height: 40px;
                min-width: 40px;
            }

            .brand-title {
                font-size: 17px;
            }

            .nav-link {
                padding: 0 14px;
                font-size: 13px;
            }

            .card-body {
                padding: 24px;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .bank-row {
                grid-template-columns: 1fr;
            }

            .copy-button {
                width: fit-content;
            }
        }
    </style>
</head>

<body>
    @php
        $isInstallment = $registration->payment_type === 'installment';
        $dpAmount = $registration->dp_amount ?: (int) ceil($registration->total_amount * 0.5);
        $remainingAmount = max((int) $registration->total_amount - (int) $dpAmount, 0);
        $amountToPay = $isInstallment ? $dpAmount : $registration->total_amount;
        $installmentDueDate = $registration->batch->start_date->copy()->subDays(30);
    @endphp

    <header class="navbar">
        <div class="container navbar-inner">
            <a href="{{ route('public.programs.index') }}" class="brand">
                <div class="brand-logo">
                    <img src="https://reframingphysio.com/wp-content/uploads/2026/02/cropped-FAVICON.png" alt="Reframing Physio">
                </div>

                <div>
                    <p class="brand-kicker">Reframing Academy</p>
                    <p class="brand-title">Payment Confirmation</p>
                </div>
            </a>

            <a href="{{ route('public.programs.index') }}" class="nav-link">
                Back to Programs
            </a>
        </div>
    </header>

    <main class="page">
        <div class="container">
            @if (session('success'))
                <div class="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error-box">
                    <strong>Please check your submission:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid">
                <section class="card hero">
                    <div class="card-body">
                        <span class="pill">Payment Summary</span>

                        <h1 class="title">
                            Complete your payment confirmation
                        </h1>

                        <p class="text">
                            Upload your transfer proof so our admin team can verify your payment and confirm your seat.
                        </p>

                        <div class="summary-grid">
                            <div class="summary-box">
                                <span>Registration Number</span>
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

                            <div class="summary-box">
                                <span>Price Category</span>
                                <strong>{{ $registration->price->label }}</strong>
                            </div>

                            <div class="summary-box">
                                <span>Total Program Fee</span>
                                <strong>Rp{{ number_format($registration->total_amount, 0, ',', '.') }}</strong>
                            </div>

                            <div class="summary-box">
                                <span>Payment Method</span>
                                <strong>{{ $isInstallment ? 'INSTALLMENT' : 'FULL PAYMENT' }}</strong>
                            </div>

                            @if ($isInstallment)
                                <div class="summary-box">
                                    <span>DP Amount</span>
                                    <strong>Rp{{ number_format($dpAmount, 0, ',', '.') }}</strong>
                                </div>

                                <div class="summary-box">
                                    <span>Remaining Balance</span>
                                    <strong>Rp{{ number_format($remainingAmount, 0, ',', '.') }}</strong>
                                </div>

                                <div class="summary-box">
                                    <span>Payment Deadline</span>
                                    <strong>{{ $installmentDueDate->format('d M Y') }}</strong>
                                </div>
                            @endif

                            <div class="summary-box">
                                <span>Payment Status</span>
                                <strong>{{ strtoupper(str_replace('_', ' ', $registration->payment_status)) }}</strong>
                            </div>
                        </div>
                    </div>
                </section>

                <aside class="card">
                    <div class="card-body">
                        <span class="pill">Bank Transfer</span>

                        <h2 class="section-title" style="margin-top: 18px;">
                            Manual Payment
                        </h2>

                        <p class="text">
                            Please transfer the exact amount below, then upload your payment proof.
                            @if ($isInstallment)
                                This registration uses installment payment. The amount below is the DP amount.
                            @endif
                        </p>

                        <div class="bank-box">
                            <div class="bank-row">
                                <span>Bank Name</span>
                                <strong>Mandiri</strong>
                            </div>

                            <div class="bank-row">
                                <span>Account Number</span>
                                <strong class="copy-value" id="bank-account-number">1310000607996</strong>
                                <button type="button" class="copy-button" data-copy="1310000607996">
                                    Copy
                                </button>
                            </div>

                            <div class="bank-row">
                                <span>Account Holder</span>
                                <strong>PT Elevasi Reframing Indonesia</strong>
                            </div>

                            <div class="bank-row">
                                <span>{{ $isInstallment ? 'DP Amount' : 'Amount' }}</span>
                                <strong class="copy-value">Rp{{ number_format($amountToPay, 0, ',', '.') }}</strong>
                                <button type="button" class="copy-button" data-copy="{{ $amountToPay }}">
                                    Copy
                                </button>
                            </div>

                            @if ($isInstallment)
                                <div class="bank-row">
                                    <span>Remaining Balance</span>
                                    <strong>Rp{{ number_format($remainingAmount, 0, ',', '.') }}</strong>
                                </div>

                                <div class="bank-row">
                                    <span>Final Payment Due</span>
                                    <strong>{{ $installmentDueDate->format('d M Y') }}</strong>
                                </div>
                            @endif

                            <div class="bank-row">
                                <span>Status</span>
                                @php
                                    $statusClass = match ($registration->payment_status) {
                                        'paid' => 'status-paid',
                                        'pending_review', 'pending' => 'status-review',
                                        default => 'status-unpaid',
                                    };
                                @endphp
                                <strong>
                                    <span class="status {{ $statusClass }}">
                                        {{ strtoupper(str_replace('_', ' ', $registration->payment_status)) }}
                                    </span>
                                </strong>
                            </div>
                        </div>

                        @if ($registration->payment_proof_path)
                            <div class="note">
                                <strong>Payment proof submitted.</strong><br>
                                Submitted at:
                                {{ $registration->payment_submitted_at ? \Carbon\Carbon::parse($registration->payment_submitted_at)->format('d M Y H:i') : '-' }}

                                <br>
                                <a
                                    href="{{ asset('storage/' . $registration->payment_proof_path) }}"
                                    target="_blank"
                                    class="proof-link"
                                >
                                    View uploaded proof
                                </a>
                            </div>
                        @endif

                        @if ($registration->payment_status !== 'paid')
                            <form
                                method="POST"
                                action="{{ route('public.payments.upload-proof', $registration->registration_number) }}"
                                enctype="multipart/form-data"
                                class="form"
                            >
                                @csrf

                                <div class="field">
                                    <label for="payment_method">Payment Method</label>
                                    <select id="payment_method" name="payment_method" required>
                                        <option value="">Select payment method</option>
                                        <option value="bank_transfer_mandiri" @selected(old('payment_method', $registration->payment_method) === 'bank_transfer_mandiri')>
                                            Bank Transfer - Mandiri
                                        </option>
                                        <option value="other_bank_transfer" @selected(old('payment_method', $registration->payment_method) === 'other_bank_transfer')>
                                            Other Bank Transfer
                                        </option>
                                    </select>
                                </div>

                                <div class="field">
                                    <label for="payment_proof">Upload Payment Proof</label>
                                    <input id="payment_proof" type="file" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf" required>
                                    <p class="help">Accepted formats: JPG, PNG, or PDF. Maximum file size: 5 MB.</p>
                                </div>

                                <div class="field">
                                    <label for="payment_notes">Payment Notes</label>
                                    <textarea id="payment_notes" name="payment_notes" placeholder="Optional notes, sender bank name, or transfer reference.">{{ old('payment_notes', $registration->payment_notes) }}</textarea>
                                </div>

                                <button type="submit" class="button">
                                    Submit Payment Proof
                                </button>
                            </form>
                        @else
                            <div class="note">
                                <strong>Payment verified.</strong><br>
                                Your payment has been confirmed by the admin team.
                            </div>
                        @endif

                        <a
                            href="{{ route('public.programs.index') }}"
                            class="button button-secondary"
                        >
                            Back to Programs
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </main>
    <script>
        document.querySelectorAll('.copy-button').forEach((button) => {
            button.addEventListener('click', async () => {
                const textToCopy = button.dataset.copy;

                try {
                    await navigator.clipboard.writeText(textToCopy);

                    const originalText = button.textContent.trim();
                    button.textContent = 'Copied';
                    button.classList.add('copied');

                    setTimeout(() => {
                        button.textContent = originalText;
                        button.classList.remove('copied');
                    }, 1600);
                } catch (error) {
                    alert('Copy failed. Please copy manually.');
                }
            });
        });
    </script>
</body>
</html>
