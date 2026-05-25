<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — LCOT</title>
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

        /* Background texture */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 10% 20%, rgba(220,38,38,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 90% 80%, rgba(59,130,246,0.04) 0%, transparent 60%);
            pointer-events: none;
        }

        .al-wrap {
            width: 100%;
            max-width: 420px;
            padding: 1.5rem;
            position: relative;
            z-index: 1;
        }

        /* Brand header */
        .al-brand {
            text-align: center;
            margin-bottom: 2rem;
        }
        .al-brand-badge {
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
        .al-brand-badge span { width: 6px; height: 6px; border-radius: 50%; background: #dc2626; display: inline-block; }
        .al-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: #f1f5f9;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }
        .al-subtitle {
            font-size: 0.82rem;
            color: #64748b;
            margin-top: 0.4rem;
        }

        /* Card */
        .al-card {
            background: #1e293b;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 24px 64px rgba(0,0,0,0.4);
        }

        /* Alert */
        .al-alert {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.25);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 0.82rem;
            color: #fca5a5;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }
        .al-alert svg { width: 1rem; height: 1rem; flex-shrink: 0; margin-top: 1px; }

        /* Form */
        .al-form-group { margin-bottom: 1.25rem; }
        .al-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: #94a3b8;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 0.4rem;
        }
        .al-input {
            width: 100%;
            padding: 0.7rem 0.9rem;
            background: #0f172a;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 0.5rem;
            font-size: 0.88rem;
            color: #e2e8f0;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }
        .al-input::placeholder { color: #475569; }
        .al-input:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220,38,38,0.12);
        }
        .al-input-wrap { position: relative; }
        .al-eye {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #475569;
            padding: 0;
            display: flex;
            align-items: center;
        }
        .al-eye:hover { color: #94a3b8; }
        .al-eye svg { width: 1rem; height: 1rem; }

        /* Remember row */
        .al-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        .al-check-label {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.8rem;
            color: #64748b;
            cursor: pointer;
        }
        .al-check { accent-color: #dc2626; }

        /* Submit button */
        .al-submit {
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
        }
        .al-submit:hover { opacity: 0.9; }
        .al-submit:active { transform: scale(0.99); }

        /* Footer links */
        .al-footer {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.78rem;
            color: #475569;
        }
        .al-footer a { color: #f59e0b; text-decoration: none; }
        .al-footer a:hover { text-decoration: underline; }

        .al-divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,0.06);
            margin: 1.5rem 0;
        }
    </style>
</head>
<body>

<div class="al-wrap">

    <div class="al-brand">
        <div class="al-brand-badge"><span></span> Staff & Admin Portal</div>
        <div class="al-title">LCOT Administration</div>
        <div class="al-subtitle">Life College of Theology &mdash; Abuja</div>
    </div>

    <div class="al-card">

        {{-- Validation errors --}}
        @if($errors->any())
            <div class="al-alert">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="al-form-group">
                <label class="al-label" for="email">Email Address</label>
                <input id="email" type="email" name="email"
                       class="al-input" value="{{ old('email') }}"
                       required autofocus autocomplete="email"
                       placeholder="admin@example.com">
            </div>

            <div class="al-form-group">
                <label class="al-label" for="password">Password</label>
                <div class="al-input-wrap">
                    <input id="al_password" type="password" name="password"
                           class="al-input" required autocomplete="current-password"
                           placeholder="••••••••"
                           style="padding-right:2.5rem;">
                    <button type="button" class="al-eye" onclick="togglePwd()" tabindex="-1" aria-label="Toggle password">
                        <svg id="al_eyeIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="al-row">
                <label class="al-check-label">
                    <input type="checkbox" name="remember" class="al-check">
                    Keep me signed in
                </label>
            </div>

            <button type="submit" class="al-submit">Sign In to Admin Panel</button>
        </form>

        <hr class="al-divider">

        <div class="al-footer">
            Student portal?
            <a href="{{ route('login') }}">Student login &rsaquo;</a>
        </div>
    </div>

    <div style="text-align:center;margin-top:1.5rem;font-size:0.72rem;color:#334155;">
        &copy; {{ date('Y') }} Life College of Theology, Abuja. All rights reserved.
    </div>
</div>

<script>
function togglePwd() {
    var inp  = document.getElementById('al_password');
    var icon = document.getElementById('al_eyeIcon');
    var showing = inp.type === 'text';
    inp.type = showing ? 'password' : 'text';
    icon.innerHTML = showing
        ? '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>'
        : '<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
}
</script>

</body>
</html>
