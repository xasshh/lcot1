<x-admin-layout>
    <x-slot name="title">Change Password</x-slot>

    <div style="max-width:480px;">

        {{-- Profile card --}}
        <div class="adm-card" style="margin-bottom:1.5rem;">
            <div class="adm-card-body" style="display:flex;align-items:center;gap:1rem;">
                <div style="width:3rem;height:3rem;border-radius:50%;background:linear-gradient(135deg,#dc2626,#b91c1c);display:flex;align-items:center;justify-content:center;font-size:1.1rem;font-weight:800;color:#fff;flex-shrink:0;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <div style="font-weight:700;color:#1e293b;font-size:0.95rem;">{{ $user->name }}</div>
                    <div style="font-size:0.8rem;color:#64748b;">{{ $user->email }}</div>
                    <div style="margin-top:0.25rem;">
                        @php
                            $rl = match($user->role) {
                                'super_admin' => ['Super Admin', 'adm-badge-amber'],
                                'admin'       => ['Admin', 'adm-badge-blue'],
                                default       => ['Staff', 'adm-badge-slate'],
                            };
                        @endphp
                        <span class="adm-badge {{ $rl[1] }}" style="font-size:0.68rem;">{{ $rl[0] }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Change password form --}}
        <div class="adm-card">
            <div class="adm-card-header">
                <div class="adm-card-title">Update Password</div>
                <div style="font-size:0.78rem;color:#94a3b8;">Minimum 8 characters</div>
            </div>
            <div class="adm-card-body">
                <form method="POST" action="{{ route('admin.account.password') }}">
                    @csrf
                    @method('PUT')

                    <div class="adm-form-group">
                        <label class="adm-label">Current Password</label>
                        <div style="position:relative;">
                            <input type="password" id="ap_current" name="current_password"
                                   class="adm-input" required
                                   placeholder="Your current password"
                                   style="padding-right:2.5rem;">
                            <button type="button" onclick="togglePwd('ap_current','ap_eye0')"
                                    style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;padding:0;display:flex;">
                                <svg id="ap_eye0" style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('current_password')
                            <div class="adm-error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label">New Password</label>
                        <div style="position:relative;">
                            <input type="password" id="ap_new" name="password"
                                   class="adm-input" required minlength="8"
                                   placeholder="Minimum 8 characters"
                                   style="padding-right:2.5rem;">
                            <button type="button" onclick="togglePwd('ap_new','ap_eye1')"
                                    style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;padding:0;display:flex;">
                                <svg id="ap_eye1" style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <div class="adm-error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="adm-form-group" style="margin-bottom:1.5rem;">
                        <label class="adm-label">Confirm New Password</label>
                        <div style="position:relative;">
                            <input type="password" id="ap_conf" name="password_confirmation"
                                   class="adm-input" required minlength="8"
                                   placeholder="Repeat your new password"
                                   style="padding-right:2.5rem;">
                            <button type="button" onclick="togglePwd('ap_conf','ap_eye2')"
                                    style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;padding:0;display:flex;">
                                <svg id="ap_eye2" style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <div class="adm-error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="adm-btn adm-btn-primary" style="width:100%;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Password
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
