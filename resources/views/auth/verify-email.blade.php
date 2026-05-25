<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email — LCOT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Figtree', system-ui, sans-serif;
            background: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 10% 20%, rgba(220,38,38,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 90% 80%, rgba(59,130,246,0.04) 0%, transparent 60%);
            pointer-events: none;
        }
        .ve-wrap {
            width: 100%;
            max-width: 460px;
            padding: 1.5rem;
            position: relative;
            z-index: 1;
        }
        .ve-brand {
            text-align: center;
            margin-bottom: 2rem;
        }
        .ve-brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(220,38,38,0.1);
            border: 1px solid rgba(220,38,38,0.2);
            border-radius: 999px;
            padding: 0.3rem 0.9rem;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #dc2626;
            margin-bottom: 1rem;
        }
        .ve-brand-badge span { width: 6px; height: 6px; border-radius: 50%; background: #dc2626; display: inline-block; }
        .ve-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #f1f5f9;
            letter-spacing: -0.02em;
        }
        .ve-subtitle { font-size: 0.82rem; color: #64748b; margin-top: 0.4rem; }

        .ve-card {
            background: #1e293b;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 1rem;
            padding: 2.25rem 2rem;
            box-shadow: 0 24px 64px rgba(0,0,0,0.4);
            text-align: center;
        }

        .ve-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: rgba(220,38,38,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        .ve-icon svg { width: 26px; height: 26px; }

        .ve-heading {
            font-size: 1.2rem;
            font-weight: 800;
            color: #f1f5f9;
            margin: 0 0 0.75rem;
            letter-spacing: -0.01em;
        }
        .ve-body {
            font-size: 0.875rem;
            color: #64748b;
            line-height: 1.7;
            margin: 0 0 1.75rem;
        }

        .ve-alert {
            border-radius: 0.5rem;
            padding: 0.7rem 1rem;
            font-size: 0.82rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            text-align: left;
        }
        .ve-alert svg { width: 0.95rem; height: 0.95rem; flex-shrink: 0; margin-top: 1px; }
        .ve-alert-sent {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            color: #94a3b8;
        }
        .ve-alert-error {
            background: rgba(220,38,38,0.08);
            border: 1px solid rgba(220,38,38,0.25);
            color: #fca5a5;
        }

        .ve-btn {
            display: block;
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            border: none;
            border-radius: 0.6rem;
            font-size: 0.88rem;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            letter-spacing: 0.02em;
            transition: opacity 0.15s, transform 0.1s;
            text-align: center;
            text-decoration: none;
        }
        .ve-btn:hover { opacity: 0.9; }
        .ve-btn:active { transform: scale(0.99); }

        .ve-divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,0.06);
            margin: 1.5rem 0;
        }

        .ve-logout {
            font-size: 0.8rem;
            color: #475569;
        }
        .ve-logout button {
            background: none;
            border: none;
            color: #64748b;
            font-size: 0.8rem;
            cursor: pointer;
            text-decoration: underline;
            padding: 0;
        }
        .ve-logout button:hover { color: #94a3b8; }
    </style>
</head>
<body>

<div class="ve-wrap">

    <div class="ve-brand">
        <div class="ve-brand-badge"><span></span> Student Portal</div>
        <div class="ve-title">LCOT Administration</div>
        <div class="ve-subtitle">Life College of Theology &mdash; Abuja</div>
    </div>

    <div class="ve-card">

        <div class="ve-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
            </svg>
        </div>

        <h1 class="ve-heading">Check your inbox</h1>

        <p class="ve-body">
            Thanks for registering! We've sent a verification link to your email address.
            Click the link in the email to activate your account and access the student portal.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="ve-alert ve-alert-sent">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                <span>A new verification link has been sent to your email address.</span>
            </div>
        @endif

        @if (session('error') || $errors->has('mail'))
            <div class="ve-alert ve-alert-error">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
                <span>{{ session('error') ?: $errors->first('mail') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="ve-btn">Resend Verification Email</button>
        </form>

        <hr class="ve-divider">

        <div class="ve-logout">
            Wrong account?
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit">Log out</button>
            </form>
        </div>

    </div>

    <div style="text-align:center;margin-top:1.5rem;font-size:0.72rem;color:#334155;">
        &copy; {{ date('Y') }} Life College of Theology, Abuja. All rights reserved.
    </div>

</div>

</body>
</html>
