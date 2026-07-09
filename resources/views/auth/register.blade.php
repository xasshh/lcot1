@include('layouts.header')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="registration-container">
        <h2>Create Account</h2>

        @if ($errors->any())
            <div style="margin-bottom:1.25rem;padding:0.9rem 1rem;background:rgba(220,38,38,0.08);border:1px solid rgba(220,38,38,0.35);border-radius:0.5rem;font-size:0.82rem;color:#dc2626;">
                <ul style="margin:0;padding:0 0 0 1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Name --}}
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <p style="margin-top:0.3rem;font-size:0.78rem;color:#dc2626;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <p style="margin-top:0.3rem;font-size:0.78rem;color:#dc2626;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Program Center --}}
        <div class="form-group">
            <label>Program Center</label>
            <select id="programCenter" name="programCenter" required>
                <option value="">Select Program Center</option>
                <option value="abuja">Abuja Center</option>
                <option value="akwanga">Akwanga Center</option>
                <option value="anyigba">Anyigba Center</option>
                <option value="asokoro">Asokoro Center</option>
                <option value="gidanmangoro">Gidan Mangoro Center</option>
                <option value="idah">Idah Center</option>
                <option value="jalingo">Jalingo Center</option>
                <option value="kubwa">Kubwa Center</option>
                <option value="makurdi">Makurdi Center</option>
                <option value="minna">Minna Center</option>
                <option value="nyanya">Nyanya Center</option>
                <option value="otukpo">Otukpo Center</option>
                <option value="suleja">Suleja Center</option>
                <option value="wuse">Wuse Center</option>
            </select>
            @error('programCenter')
                <p style="margin-top:0.3rem;font-size:0.78rem;color:#dc2626;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Programme --}}
        <div class="form-group">
            <label>Programme</label>
            <select id="programTaken" name="programTaken" required>
                <option value="">Select Programme</option>
                <option value="bachelor" {{ old('programTaken') === 'bachelor' ? 'selected' : '' }}>Bachelor's Degree Programme</option>
                <option value="special_executive" {{ old('programTaken') === 'special_executive' ? 'selected' : '' }}>Special Executive Bachelor's Degree</option>
                <option value="masters" {{ old('programTaken') === 'masters' ? 'selected' : '' }}>Master's Degree Programme</option>
            </select>
            @error('programTaken')
                <p style="margin-top:0.3rem;font-size:0.78rem;color:#dc2626;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Year Admitted --}}
        <div class="form-group">
            <label>Year Admitted</label>
            <select id="yearAdmitted" name="yearAdmitted" required>
                <option value="">Select Year</option>
                @for($y = 2020; $y <= 2026; $y++)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>
            @error('yearAdmitted')
                <p style="margin-top:0.3rem;font-size:0.78rem;color:#dc2626;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Matric Number --}}
        <div class="form-group">
            <label>Matric Number</label>
            <div class="matric-input-wrapper">
                <span id="matricPrefix">--/--/----/</span>
                <input type="text" name="matric_suffix" placeholder="Enter unique number" required>
            </div>

            {{-- Hidden field sent to backend --}}
            <input type="hidden" name="full_matric_number" id="fullMatricNumber">
            @error('matric_suffix')
                <p style="margin-top:0.3rem;font-size:0.78rem;color:#dc2626;">{{ $message }}</p>
            @enderror
            @error('full_matric_number')
                <p style="margin-top:0.3rem;font-size:0.78rem;color:#dc2626;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label>Password</label>
            <div class="password-input">
                <input type="password" id="password" name="password" required style="padding-right:2.75rem;" autocomplete="new-password">
                <button type="button" class="toggle-password" data-target="password" tabindex="-1" aria-label="Toggle password visibility">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password')
                <p style="margin-top:0.3rem;font-size:0.78rem;color:#dc2626;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="form-group">
            <label>Confirm Password</label>
            <div class="password-input">
                <input type="password" id="password_confirmation" name="password_confirmation" required style="padding-right:2.75rem;" autocomplete="new-password">
                <button type="button" class="toggle-password" data-target="password_confirmation" tabindex="-1" aria-label="Toggle password visibility">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password_confirmation')
                <p style="margin-top:0.3rem;font-size:0.78rem;color:#dc2626;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="submit-btn">Create Account</button>

        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
    <script>
const programAbbreviations = {
    'bachelor': 'BDP',
    'special_executive': 'SEB',
    'masters': 'MDP'
};

function updateMatricPrefix() {
    const center = document.getElementById('programCenter');
    const program = document.getElementById('programTaken');
    const year = document.getElementById('yearAdmitted');
    const prefixSpan = document.getElementById('matricPrefix');
    const hiddenInput = document.getElementById('fullMatricNumber');
    const suffix = document.querySelector('[name="matric_suffix"]').value || '';

    let prefix = '';

    if (center.value) {
        const text = center.options[center.selectedIndex].text.replace(' Center','');
        prefix += text.substring(0,2).toUpperCase() + '/';
    } else prefix += '--/';

    prefix += program.value ? programAbbreviations[program.value] + '/' : '--/';
    prefix += year.value ? year.value + '/' : '----/';

    prefixSpan.textContent = prefix;
    hiddenInput.value = prefix + suffix;
}

document.addEventListener('DOMContentLoaded', () => {
    ['programCenter', 'programTaken', 'yearAdmitted'].forEach(id => {
        document.getElementById(id).addEventListener('change', updateMatricPrefix);
    });
    document.querySelector('[name="matric_suffix"]').addEventListener('input', updateMatricPrefix);
    updateMatricPrefix();
});
</script>

</form>



    @include('layouts.footer')
