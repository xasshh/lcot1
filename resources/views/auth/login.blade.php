@include('layouts.header')

<section class="login-section">
    <div class="login-container">
        <div class="login-box">
            <h2>Student Login</h2>

            @if (session('status'))
                <div style="margin-bottom:1rem;padding:0.8rem 1rem;background:rgba(22,163,74,0.08);border:1px solid rgba(22,163,74,0.35);border-radius:0.5rem;font-size:0.84rem;color:#16a34a;text-align:center;">
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

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           autocomplete="username">
                    @error('email')
                        <p style="margin-top:0.3rem;font-size:0.78rem;color:#dc2626;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Matric / Registration Number --}}
                <div class="form-group">
                    <label for="matric_number">Registration Number</label>
                    <input type="text"
                           id="matric_number"
                           name="matric_number"
                           value="{{ old('matric_number') }}"
                           required
                           autocomplete="username">
                    @error('matric_number')
                        <p style="margin-top:0.3rem;font-size:0.78rem;color:#dc2626;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-input">
                        <input type="password"
                               id="password"
                               name="password"
                               required
                               style="padding-right:2.75rem;"
                               autocomplete="current-password">
                        <button type="button"
                                class="toggle-password"
                                tabindex="-1"
                                aria-label="Toggle password visibility">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p style="margin-top:0.3rem;font-size:0.78rem;color:#dc2626;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me + Forgot Password --}}
                <div class="remember-forgot">
                    <div class="remember-me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <label for="remember_me">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="login-btn">Log in</button>

                <div style="text-align:center;margin-top:1rem;">
                    <a href="{{ route('register') }}"
                       style="font-size:0.875rem;color:#2c5282;text-decoration:none;">
                        Don't have an account? Register
                    </a>
                </div>
            </form>

            <div class="login-footer">
                <p>Need help? Contact <a href="#">IT Support</a></p>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
