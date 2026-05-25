<x-admin-layout>
    <x-slot name="title">Manage Staff</x-slot>

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
        <div></div>
        <a href="{{ route('admin.staff.create') }}" class="adm-btn adm-btn-primary">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Add Staff Member
        </a>
    </div>

    <div class="adm-card">
        <div class="adm-card-header">
            <div class="adm-card-title">
                All Staff & Admins
                <span class="adm-badge adm-badge-slate" style="margin-left:0.5rem;">{{ $staff->count() }}</span>
            </div>
        </div>
        <div style="overflow-x:auto;">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Member Since</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($staff as $member)
                        @php
                            $roleLabel = match($member->role) {
                                'super_admin' => ['Super Admin', 'adm-badge-amber'],
                                'admin'       => ['Admin', 'adm-badge-blue'],
                                default       => ['Staff', 'adm-badge-slate'],
                            };
                        @endphp
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:0.625rem;">
                                    <div style="width:2rem;height:2rem;border-radius:50%;background:linear-gradient(135deg,#dc2626,#b91c1c);display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:#fff;flex-shrink:0;">
                                        {{ strtoupper(substr($member->name, 0, 1)) }}
                                    </div>
                                    <span style="font-weight:600;color:#1e293b;">{{ $member->name }}</span>
                                    @if($member->id === auth()->id())
                                        <span class="adm-badge adm-badge-green" style="font-size:0.65rem;">You</span>
                                    @endif
                                </div>
                            </td>
                            <td style="color:#64748b;font-size:0.82rem;">{{ $member->email }}</td>
                            <td><span class="adm-badge {{ $roleLabel[1] }}">{{ $roleLabel[0] }}</span></td>
                            <td style="color:#64748b;font-size:0.82rem;">{{ $member->created_at->format('d M Y') }}</td>
                            <td style="text-align:right;">
                                @if(!$member->isSuperAdmin())
                                    <form method="POST" action="{{ route('admin.staff.destroy', $member) }}"
                                          style="display:inline;"
                                          onsubmit="return confirm('Remove {{ addslashes($member->name) }} from staff? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Remove
                                        </button>
                                    </form>
                                @else
                                    <span style="font-size:0.75rem;color:#94a3b8;padding:0.3rem 0.65rem;">Protected</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;padding:2.5rem;color:#94a3b8;">
                                No staff accounts found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
