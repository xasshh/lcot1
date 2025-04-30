@include('layouts.header')  
  <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="registration-container">
            <h2>Create Account</h2>
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="form-group" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="form-group">
            <x-input-label for="matric_number" :value="__('Matric Number')" />
            <x-text-input id="matric_number" class="block mt-1 w-full" type="text" name="matric_number" :value="old('matric_number')" required />
            <x-input-error :messages="$errors->get('matric_number')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- <div class="login-link">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a> --}}

            <x-primary-button class="submit-btn">
                {{ __('Register') }}
            </x-primary-button>
            <div class="login-link">
                Already have an account? <a href="{{ route('login') }}">Login here</a>
            </div>
        </div>
    </form>
</div>
    @include('layouts.footer')
