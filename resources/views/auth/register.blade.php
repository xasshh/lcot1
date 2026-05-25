@include('layouts.header')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="registration-container">
        <h2>Create Account</h2>

        @if ($errors->any())
            <div style="margin-bottom:1.25rem;padding:0.9rem 1rem;background:rgba(220,38,38,0.08);border:1px solid rgba(220,38,38,0.35);border-radius:0.5rem;font-size:0.82rem;color:#fca5a5;">
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
            <input type="text" name="name" required>
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
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
        </div>

        {{-- Program Taken --}}
        <div class="form-group">
            <label>Program Taken</label>
            <select id="programTaken" name="programTaken" required
                    style="opacity:0.45;pointer-events:none;cursor:not-allowed;">
                <option value="">Select Program Center first</option>
            </select>
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
        </div>

        <button type="submit" class="submit-btn">Create Account</button>

        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
    <script>
const programCenterMapping = {
    'abuja': ['M.th'],
    'akwanga': ['CCM'],
    'anyigba': ['B.th', 'CCM', 'Diploma'],
    'asokoro': ['CCM'],
    'gidanmangoro': ['CCM'],
    'idah': ['B.th', 'CCM', 'Diploma'],
    'jalingo': ['B.th', 'CCM', 'Diploma'],
    'kubwa': ['B.th', 'CCM', 'Diploma'],
    'makurdi': ['CCM'],
    'minna': ['B.th', 'CCM', 'Diploma'],
    'nyanya': ['B.th', 'CCM', 'Diploma'],
    'otukpo': ['B.th', 'Diploma'],
    'suleja': ['CCM'],
    'wuse': ['CCM']
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

    prefix += program.value ? program.value + '/' : '--/';
    prefix += year.value ? year.value + '/' : '----/';

    prefixSpan.textContent = prefix;
    hiddenInput.value = prefix + suffix;
}

document.addEventListener('DOMContentLoaded', () => {
    const center = document.getElementById('programCenter');
    const program = document.getElementById('programTaken');
    const year = document.getElementById('yearAdmitted');

    center.addEventListener('change', () => {
        program.innerHTML = '<option value="">Select Program Taken</option>';

        if (center.value) {
            program.style.opacity = '';
            program.style.pointerEvents = '';
            program.style.cursor = '';
            (programCenterMapping[center.value] || []).forEach(p => {
                const opt = document.createElement('option');
                opt.value = p;
                opt.textContent = p;
                program.appendChild(opt);
            });
        } else {
            program.style.opacity = '0.45';
            program.style.pointerEvents = 'none';
            program.style.cursor = 'not-allowed';
        }

        updateMatricPrefix();
    });

    program.addEventListener('change', updateMatricPrefix);
    year.addEventListener('change', updateMatricPrefix);
    document.querySelector('[name="matric_suffix"]').addEventListener('input', updateMatricPrefix);
});
</script>

</form>



    @include('layouts.footer')
