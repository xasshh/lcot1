@include('layouts.header')  
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="registration-container">
        <h2>Create Account</h2>

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
            <select id="programTaken" name="programTaken" disabled required>
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
            <input type="password" name="password" required>
        </div>

        {{-- Confirm Password --}}
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>
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
        program.disabled = !center.value;

        (programCenterMapping[center.value] || []).forEach(p => {
            const opt = document.createElement('option');
            opt.value = p;
            opt.textContent = p;
            program.appendChild(opt);
        });

        updateMatricPrefix();
    });

    program.addEventListener('change', updateMatricPrefix);
    year.addEventListener('change', updateMatricPrefix);
    document.querySelector('[name="matric_suffix"]').addEventListener('input', updateMatricPrefix);
});
</script>

</form>



    @include('layouts.footer')
