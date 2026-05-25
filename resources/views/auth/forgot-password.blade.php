@include('layouts.header')

<section class="login-section">
    <div class="login-container">
        <div class="login-box">
            <h2>Reset Password</h2>

            <p style="font-size:0.875rem;color:#64748b;text-align:center;margin:0 0 1.5rem;line-height:1.6;">
                Enter your email address and we'll send you a link to reset your password.
            </p>

            @if (session('status'))
                <div style="margin-bottom:1.25rem;padding:0.9rem 1rem;background:rgba(22,163,74,0.08);border:1px solid rgba(22,163,74,0.35);border-radius:0.5rem;font-size:0.85rem;color:#16a34a;text-align:center;">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div style="margin-bottom:1.25rem;padding:0.9rem 1rem;background:rgba(220,38,38,0.08);border:1px solid rgba(220,38,38,0.35);border-radius:0.5rem;font-size:0.82rem;color:#dc2626;">
                    <ul style="margin:0;padding:0 0 0 1.25rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           autocomplete="username"
                           placeholder="Enter your registered email">
                </div>

                <button type="submit" class="login-btn" style="margin-top:0.5rem;">
                    Send Reset Link
                </button>
            </form>

            <div class="login-footer">
                <p>Remembered your password? <a href="{{ route('login') }}">Back to Login</a></p>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
