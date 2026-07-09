<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>

    {{-- Stats --}}
    <div class="adm-stat-grid">
        <div class="adm-stat-card">
            <div class="adm-stat-icon" style="background:#fee2e2;">
                <svg fill="none" viewBox="0 0 24 24" stroke="#991b1b" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <div class="adm-stat-value">{{ $stats['total_students'] }}</div>
                <div class="adm-stat-label">Total Students</div>
            </div>
        </div>
        <div class="adm-stat-card">
            <div class="adm-stat-icon" style="background:#eff6ff;">
                <svg fill="none" viewBox="0 0 24 24" stroke="#1d4ed8" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <div class="adm-stat-value">{{ $stats['total_staff'] }}</div>
                <div class="adm-stat-label">Staff & Admins</div>
            </div>
        </div>
        <div class="adm-stat-card">
            <div class="adm-stat-icon" style="background:#ecfdf5;">
                <svg fill="none" viewBox="0 0 24 24" stroke="#065f46" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div>
                <div class="adm-stat-value">{{ $stats['total_courses'] }}</div>
                <div class="adm-stat-label">Courses</div>
            </div>
        </div>
    </div>

    {{-- Quick links --}}
    <div class="adm-grid-3">
        <a href="{{ route('admin.students.index') }}" class="adm-card"
           style="text-decoration:none;padding:1.5rem;display:flex;flex-direction:column;gap:0.5rem;">
            <div style="font-weight:700;color:#1e293b;font-size:0.95rem;">Manage Students</div>
            <div style="font-size:0.8rem;color:#64748b;">View, edit, assign courses and update academic records.</div>
            <div style="margin-top:auto;padding-top:0.75rem;font-size:0.78rem;color:#dc2626;font-weight:600;">Open &rsaquo;</div>
        </a>
        <a href="{{ route('admin.courses.index') }}" class="adm-card"
           style="text-decoration:none;padding:1.5rem;display:flex;flex-direction:column;gap:0.5rem;">
            <div style="font-weight:700;color:#1e293b;font-size:0.95rem;">Manage Courses</div>
            <div style="font-size:0.8rem;color:#64748b;">Add, edit or remove courses and assign instructors.</div>
            <div style="margin-top:auto;padding-top:0.75rem;font-size:0.78rem;color:#dc2626;font-weight:600;">Open &rsaquo;</div>
        </a>
        <a href="{{ route('admin.timetable.index') }}" class="adm-card"
           style="text-decoration:none;padding:1.5rem;display:flex;flex-direction:column;gap:0.5rem;">
            <div style="font-weight:700;color:#1e293b;font-size:0.95rem;">Timetables</div>
            <div style="font-size:0.8rem;color:#64748b;">Upload and manage course & exam timetables for students.</div>
            <div style="margin-top:auto;padding-top:0.75rem;font-size:0.78rem;color:#dc2626;font-weight:600;">Open &rsaquo;</div>
        </a>
    </div>
</x-admin-layout>
