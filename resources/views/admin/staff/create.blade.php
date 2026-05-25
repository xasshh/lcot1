<x-admin-layout>
    <x-slot name="title">Add Staff Member</x-slot>

    <div style="max-width:520px;">
        <div style="margin-bottom:1.25rem;">
            <a href="{{ route('admin.staff.index') }}" class="adm-btn adm-btn-secondary adm-btn-sm">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Staff
            </a>
        </div>

        <div class="adm-card">
            <div class="adm-card-header">
                <div class="adm-card-title">New Staff Account</div>
                <div style="font-size:0.78rem;color:#94a3b8;">The staff member will use these credentials to log in</div>
            </div>
            <div class="adm-card-body">
                <form method="POST" action="{{ route('admin.staff.store') }}">
                    @csrf

                    <div class="adm-form-group">
                        <label class="adm-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="adm-input" required placeholder="e.g. Dr. John Adeyemi">
                        @error('name')<div class="adm-error-text">{{ $message }}</div>@enderror
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="adm-input" required placeholder="staff@example.com">
                        @error('email')<div class="adm-error-text">{{ $message }}</div>@enderror
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label">Role</label>
                        <select name="role" class="adm-select" required>
                            <option value="staff"  {{ old('role','staff') === 'staff'  ? 'selected' : '' }}>Staff / Lecturer</option>
                            <option value="admin"  {{ old('role') === 'admin'  ? 'selected' : '' }}>Admin</option>
                        </select>
                        <div style="font-size:0.72rem;color:#94a3b8;margin-top:0.3rem;">
                            Staff can manage students &amp; courses. Admin can also access all management tools.
                        </div>
                        @error('role')<div class="adm-error-text">{{ $message }}</div>@enderror
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label">Temporary Password</label>
                        <div style="position:relative;">
                            <input type="password" id="sc_pwd" name="password"
                                   class="adm-input" required minlength="8"
                                   placeholder="Minimum 8 characters"
                                   style="padding-right:2.5rem;">
                            <button type="button" onclick="togglePwd('sc_pwd','sc_eye')"
                                    style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;padding:0;display:flex;">
                                <svg id="sc_eye" style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')<div class="adm-error-text">{{ $message }}</div>@enderror
                    </div>

                    <div class="adm-form-group" style="margin-bottom:0;">
                        <label class="adm-label">Confirm Password</label>
                        <div style="position:relative;">
                            <input type="password" id="sc_pwd_conf" name="password_confirmation"
                                   class="adm-input" required minlength="8"
                                   placeholder="Repeat the password"
                                   style="padding-right:2.5rem;">
                            <button type="button" onclick="togglePwd('sc_pwd_conf','sc_eye_conf')"
                                    style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;padding:0;display:flex;">
                                <svg id="sc_eye_conf" style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password_confirmation')<div class="adm-error-text">{{ $message }}</div>@enderror
                    </div>

                    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:0.5rem;padding:0.75rem 1rem;margin:1.25rem 0;font-size:0.8rem;color:#991b1b;display:flex;gap:0.5rem;align-items:flex-start;">
                        <svg style="width:1rem;height:1rem;flex-shrink:0;margin-top:1px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>Share these credentials with the staff member directly. They should change their password after their first login via <strong>Admin Panel &rsaquo; Change Password</strong>.</div>
                    </div>

                    <button type="submit" class="adm-btn adm-btn-primary" style="width:100%;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Create Staff Account
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
    function togglePwd(inputId, iconId) {
        var inp  = document.getElementById(inputId);
        var icon = document.getElementById(iconId);
        var show = inp.type === 'password';
        inp.type = show ? 'text' : 'password';
        icon.innerHTML = show
            ? '<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>'
            : '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
    }
    </script>
</x-admin-layout>
