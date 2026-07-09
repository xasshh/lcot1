<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} — LCOT Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Admin layout overrides */
        .adm-sidebar {
            background: #0f172a;
            width: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }
        .adm-brand {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .adm-brand-title {
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #dc2626;
        }
        .adm-brand-sub {
            font-size: 0.7rem;
            color: #64748b;
            margin-top: 2px;
        }
        .adm-nav { padding: 1rem 0; flex: 1; }
        .adm-nav-section {
            padding: 0.5rem 1.25rem 0.25rem;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #475569;
        }
        .adm-nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.6rem 1.25rem;
            font-size: 0.82rem;
            font-weight: 500;
            color: #94a3b8;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
            border-left: 3px solid transparent;
        }
        .adm-nav-link:hover {
            background: rgba(255,255,255,0.04);
            color: #e2e8f0;
        }
        .adm-nav-link.active {
            background: rgba(220,38,38,0.08);
            color: #f87171;
            border-left-color: #dc2626;
        }
        .adm-nav-link svg { width: 1rem; height: 1rem; flex-shrink: 0; opacity: 0.8; }
        .adm-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,0.06);
        }
        .adm-user-card {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            margin-bottom: 0.75rem;
        }
        .adm-avatar {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }
        .adm-user-name { font-size: 0.8rem; font-weight: 600; color: #e2e8f0; }
        .adm-user-role { font-size: 0.7rem; color: #64748b; }
        .adm-signout {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            width: 100%;
            background: none;
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 0.375rem;
            color: #f87171;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.45rem 0.75rem;
            cursor: pointer;
            text-align: left;
            transition: background 0.15s, border-color 0.15s;
        }
        .adm-signout:hover { background: rgba(239,68,68,0.08); border-color: rgba(239,68,68,0.5); }
        .adm-signout svg { width: 0.875rem; height: 0.875rem; }

        .adm-main { flex: 1; min-height: 100vh; background: #f8fafc; }
        .adm-topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.875rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .adm-page-title { font-size: 1.05rem; font-weight: 700; color: #1e293b; }
        .adm-breadcrumb { font-size: 0.78rem; color: #94a3b8; margin-top: 1px; }
        .adm-content { padding: 1.75rem; }

        /* Flash messages */
        .adm-flash {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .adm-flash-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .adm-flash-error   { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        /* Cards */
        .adm-card {
            background: #fff;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }
        .adm-card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .adm-card-title { font-size: 0.9rem; font-weight: 700; color: #1e293b; }
        .adm-card-body { padding: 1.5rem; }

        /* Table */
        .adm-table { width: 100%; border-collapse: collapse; font-size: 0.83rem; }
        .adm-table thead tr { background: #1e293b; }
        .adm-table thead th {
            padding: 0.75rem 1rem;
            text-align: left;
            color: #94a3b8;
            font-weight: 600;
            font-size: 0.72rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            white-space: nowrap;
        }
        .adm-table tbody tr { border-bottom: 1px solid #f1f5f9; }
        .adm-table tbody tr:hover { background: #f8fafc; }
        .adm-table tbody td { padding: 0.75rem 1rem; color: #374151; vertical-align: middle; }

        /* Badges */
        .adm-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.55rem;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.02em;
        }
        .adm-badge-amber  { background: #fee2e2; color: #991b1b; }
        .adm-badge-slate  { background: #f1f5f9; color: #475569; }
        .adm-badge-green  { background: #ecfdf5; color: #065f46; }
        .adm-badge-red    { background: #fef2f2; color: #991b1b; }
        .adm-badge-blue   { background: #eff6ff; color: #1d4ed8; }

        /* Buttons */
        .adm-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: opacity 0.15s;
        }
        .adm-btn:hover { opacity: 0.85; }
        .adm-btn-primary { background: #dc2626; color: #fff; }
        .adm-btn-secondary { background: #e2e8f0; color: #475569; }
        .adm-btn-danger { background: #ef4444; color: #fff; }
        .adm-btn-sm { padding: 0.3rem 0.65rem; font-size: 0.75rem; }
        .adm-btn svg { width: 0.875rem; height: 0.875rem; }

        /* Form inputs */
        .adm-input, .adm-select, .adm-textarea {
            width: 100%;
            padding: 0.55rem 0.875rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 0.85rem;
            color: #1e293b;
            background: #fff;
            transition: border-color 0.15s, box-shadow 0.15s;
            outline: none;
        }
        .adm-input:focus, .adm-select:focus, .adm-textarea:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220,38,38,0.12);
        }
        .adm-textarea { resize: vertical; min-height: 120px; }
        .adm-label { display: block; font-size: 0.78rem; font-weight: 600; color: #374151; margin-bottom: 0.35rem; }
        .adm-form-group { margin-bottom: 1.25rem; }
        .adm-error-text { font-size: 0.75rem; color: #ef4444; margin-top: 0.25rem; }

        /* Stats */
        .adm-stat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem; }
        .adm-stat-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .adm-stat-icon {
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 0.625rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .adm-stat-icon svg { width: 1.25rem; height: 1.25rem; }
        .adm-stat-value { font-size: 1.75rem; font-weight: 800; color: #1e293b; line-height: 1; }
        .adm-stat-label { font-size: 0.75rem; color: #64748b; font-weight: 500; margin-top: 0.2rem; }

        /* Search bar */
        .adm-search-wrap { position: relative; }
        .adm-search-icon { position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none; }
        .adm-search-icon svg { width: 0.875rem; height: 0.875rem; }
        .adm-search-input { padding-left: 2.25rem !important; }

        /* Pagination — keep Tailwind classes but add colour */
        .adm-pagination { display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem; }
        .adm-pagination a, .adm-pagination span {
            padding: 0.35rem 0.65rem;
            border-radius: 0.375rem;
            font-size: 0.78rem;
            font-weight: 500;
            border: 1px solid #e2e8f0;
            color: #475569;
            text-decoration: none;
        }
        .adm-pagination .active { background: #dc2626; color: #fff; border-color: #dc2626; font-weight: 700; }

        /* ── Responsive layout helpers ── */
        .adm-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        .adm-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
        .adm-split  { display: grid; grid-template-columns: 1fr 340px; gap: 1.5rem; align-items: start; }

        .adm-burger {
            display: none;
            background: none;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.45rem 0.6rem;
            cursor: pointer;
            color: #475569;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }
        .adm-burger svg { width: 1.15rem; height: 1.15rem; display: block; }
        .adm-overlay { display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.55); z-index: 65; }

        @media (max-width: 1024px) {
            .adm-sidebar {
                position: fixed;
                top: 0; left: 0; bottom: 0;
                z-index: 70;
                width: 270px;
                min-height: 0;
                overflow-y: auto;
                transform: translateX(-105%);
                transition: transform 0.25s ease;
            }
            .adm-sidebar.open { transform: translateX(0); box-shadow: 0 0 40px rgba(0,0,0,0.35); }
            .adm-overlay.show { display: block; }
            .adm-burger { display: inline-flex; align-items: center; }
            .adm-split { grid-template-columns: 1fr; }
            .adm-content { padding: 1.25rem; }
        }
        @media (max-width: 768px) {
            .adm-grid-2 { grid-template-columns: 1fr; }
            .adm-grid-3 { grid-template-columns: 1fr 1fr; }
            .adm-stat-grid { grid-template-columns: 1fr 1fr; }
            .adm-topbar { padding: 0.75rem 1rem; }
            .adm-content { padding: 1rem; }
            .adm-card-header { padding: 0.875rem 1rem; flex-wrap: wrap; gap: 0.5rem; }
            .adm-card-body { padding: 1rem; }
        }
        @media (max-width: 560px) {
            .adm-grid-3 { grid-template-columns: 1fr; }
            .adm-stat-grid { grid-template-columns: 1fr; }
            .adm-topbar-date { display: none; }
            .adm-page-title { font-size: 0.95rem; }
        }

        /* Modal */
        .adm-modal-overlay {
            position: fixed; inset: 0;
            background: rgba(15,23,42,0.6);
            display: flex; align-items: center; justify-content: center;
            z-index: 50;
            padding: 1rem;
        }
        .adm-modal {
            background: #fff;
            border-radius: 0.875rem;
            width: 100%;
            max-width: 540px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .adm-modal-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex; align-items: center; justify-content: space-between;
        }
        .adm-modal-title { font-size: 0.95rem; font-weight: 700; color: #1e293b; }
        .adm-modal-close { background: none; border: none; cursor: pointer; color: #94a3b8; padding: 0.25rem; }
        .adm-modal-close:hover { color: #374151; }
        .adm-modal-body { padding: 1.5rem; }
        .adm-modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #f1f5f9;
            display: flex; justify-content: flex-end; gap: 0.5rem;
        }
    </style>
</head>
<body style="margin:0;font-family:'Figtree',system-ui,sans-serif;background:#f8fafc;">
<div style="display:flex;min-height:100vh;">

    {{-- ===== SIDEBAR ===== --}}
    @php $seg = request()->segment(2) ?? ''; @endphp
    <div class="adm-overlay" id="admOverlay" onclick="admToggleSidebar(false)"></div>
    <aside class="adm-sidebar" id="admSidebar">
        <div class="adm-brand">
            <div class="adm-brand-title">LCOT Admin</div>
            <div class="adm-brand-sub">Life College of Theology</div>
        </div>

        <nav class="adm-nav">
            <div class="adm-nav-section">Overview</div>
            <a href="{{ route('admin.dashboard') }}"
               class="adm-nav-link {{ $seg === '' || $seg === null ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <div class="adm-nav-section" style="margin-top:0.75rem;">Management</div>
            <a href="{{ route('admin.students.index') }}"
               class="adm-nav-link {{ $seg === 'students' ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Students
            </a>
            <a href="{{ route('admin.courses.index') }}"
               class="adm-nav-link {{ $seg === 'courses' ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Courses
            </a>
            <a href="{{ route('admin.timetable.index') }}"
               class="adm-nav-link {{ $seg === 'timetable' ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Timetables
            </a>

            @if(auth()->user()->isSuperAdmin())
            <div class="adm-nav-section" style="margin-top:0.75rem;">Administration</div>
            <a href="{{ route('admin.results.index') }}"
               class="adm-nav-link {{ $seg === 'results' ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Results
            </a>
            <a href="{{ route('admin.staff.index') }}"
               class="adm-nav-link {{ $seg === 'staff' ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Manage Staff
            </a>
            @endif

            <div class="adm-nav-section" style="margin-top:0.75rem;">Account</div>
            <a href="{{ route('admin.account.edit') }}"
               class="adm-nav-link {{ $seg === 'account' ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
                Change Password
            </a>

            <div class="adm-nav-section" style="margin-top:0.75rem;">Portal</div>
            <a href="{{ route('dashboard') }}" class="adm-nav-link">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Student Portal
            </a>
        </nav>

        <div class="adm-footer">
            <div class="adm-user-card">
                <div class="adm-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <div class="adm-user-name">{{ auth()->user()->name }}</div>
                    <div class="adm-user-role">{{ auth()->user()->role === 'super_admin' ? 'Super Admin' : ucfirst(auth()->user()->role ?? 'staff') }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="adm-signout">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- ===== MAIN ===== --}}
    <div class="adm-main">
        <div class="adm-topbar">
            <div style="display:flex;align-items:center;min-width:0;">
                <button type="button" class="adm-burger" onclick="admToggleSidebar()" aria-label="Open menu">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div style="min-width:0;">
                    <div class="adm-page-title">{{ $title ?? 'Dashboard' }}</div>
                    <div class="adm-breadcrumb">Admin Panel &rsaquo; {{ $title ?? 'Dashboard' }}</div>
                </div>
            </div>
            <div style="display:flex;align-items:center;gap:0.75rem;">
                <span class="adm-topbar-date" style="font-size:0.78rem;color:#64748b;">{{ now()->format('D, d M Y') }}</span>
            </div>
        </div>
        <div class="adm-content">
            @if(session('success'))
                <div class="adm-flash adm-flash-success">
                    <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="adm-flash adm-flash-error">
                    <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif
            {{ $slot }}
        </div>
    </div>

</div>
<script>
function admToggleSidebar(force) {
    var sb = document.getElementById('admSidebar');
    var ov = document.getElementById('admOverlay');
    var open = typeof force === 'boolean' ? force : !sb.classList.contains('open');
    sb.classList.toggle('open', open);
    ov.classList.toggle('show', open);
}
</script>
</body>
</html>
