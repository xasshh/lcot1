@include('layouts.header')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <section class="login-section">
            <div class="login-container">
                <div class="login-box">
                    <h2>Student Login</h2>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email"  class="form-group" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <div>
            <x-input-label for="matric_number" :value="__('Registration Number')" />
            <x-text-input id="matric_number" class="form-group" type="text" name="matric_number" :value="old('matric_number')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('matric_number')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" />
            <div class="password-input">
                <x-text-input id="password"
                                class="block w-full"
                                style="padding-right:2.75rem;"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <button type="button"
                        class="toggle-password"
                        tabindex="-1"
                        aria-label="Toggle password visibility">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="form-options">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div  class="form-group">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="login-btn">
                {{ __('Log in') }}
            </x-primary-button>
            <a href="{{ route('register') }}" class="login-btn space-down">Register</a>
        </div>
    </form>
    <div class="login-footer">
        <p>Need help? Contact <a href="#">IT Support</a></p>
    </div>
</div>
</div>
</section>
    @include('layouts.footer')
