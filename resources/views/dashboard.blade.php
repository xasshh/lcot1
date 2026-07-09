<x-app-layout>
<style>
    /* ── Dashboard premium theme ── */
    .db-sidebar {
        position: sticky;
        top: 0;
        height: 100vh;
        background: #0f172a;
        border-right: 1px solid rgba(255,255,255,0.06);
        overflow-y: auto;
    }

    /* Profile avatar */
    .db-avatar {
        border: 3px solid #dc2626;
        transition: transform 0.25s ease;
    }
    .db-avatar:hover { transform: scale(1.06); }

    /* Data table */
    .db-table { width: 100%; border-collapse: collapse; }
    .db-table thead th {
        background: #1e293b;
        color: #f1f5f9;
        padding: 11px 16px;
        text-align: left;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        white-space: nowrap;
    }
    .db-table thead th:first-child { border-radius: 0; }
    .db-table tbody td {
        padding: 11px 16px;
        font-size: 0.875rem;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    .db-table tbody tr:last-child td { border-bottom: none; }
    .db-table tbody tr:hover td { background: #f8fafc; }

    /* Stat card hover */
    .db-stat-card { transition: box-shadow 0.2s ease, transform 0.2s ease; }
    .db-stat-card:hover { box-shadow: 0 6px 24px rgba(0,0,0,0.09); transform: translateY(-2px); }

    /* Section card hover */
    .db-card { transition: box-shadow 0.2s ease; }
    .db-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.07); }

    /* Section divider label */
    .db-label {
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #94a3b8;
    }

    /* Progress track */
    .db-track { background: #f1f5f9; height: 6px; border-radius: 9999px; overflow: hidden; }
    .db-fill  { background: linear-gradient(to right, #dc2626, #b91c1c); height: 6px; border-radius: 9999px; }

    /* Override app-level link hover for sidebar */
    .db-sidebar a:hover { color: inherit; text-decoration: none; }
</style>

<div class="flex min-h-screen" style="background:#f1f5f9;">

    {{-- ── Sidebar (desktop only) ── --}}
    <aside class="hidden lg:flex w-64 flex-shrink-0 flex-col db-sidebar px-4 py-6">

        {{-- Brand --}}
        <div class="flex items-center gap-3 mb-6 pb-5 border-b border-white/10 px-1">
            <div class="w-8 h-8 rounded-lg bg-red-600 flex items-center justify-center flex-shrink-0 shadow">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-white text-sm font-bold leading-tight">Student Portal</p>
                <p class="text-slate-500 text-xs truncate">Life College of Theology</p>
            </div>
        </div>

        {{-- Mini user card --}}
        <div class="flex items-center gap-2.5 mb-6 px-3 py-2.5 bg-white/5 rounded-xl border border-white/5">
            @if(auth()->user()->profile_photo)
                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                     class="w-9 h-9 rounded-full object-cover border-2 border-red-600 flex-shrink-0">
            @else
                <div class="w-9 h-9 rounded-full bg-slate-700 border-2 border-slate-600 flex items-center justify-center text-slate-200 text-sm font-bold flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            @endif
            <div class="min-w-0">
                <p class="text-white text-xs font-semibold truncate">{{ auth()->user()->name }}</p>
                <p class="text-slate-500 text-xs truncate">{{ auth()->user()->matric_number ?? 'Student' }}</p>
            </div>
        </div>

        {{-- Nav --}}
        <p class="db-label px-2 mb-2">Menu</p>
        @php $route = request()->route()?->getName() ?? ''; @endphp
        <ul class="list-none m-0 p-0 flex flex-col gap-0.5 flex-1">
            <li>
                <a href="{{ route('home') }}"
                   class="flex items-center gap-3 py-2.5 text-sm font-medium transition-colors duration-150
                          {{ $route === 'home'
                             ? 'pl-3 pr-4 border-l-4 border-red-500 bg-white/10 text-white rounded-r-xl font-semibold'
                             : 'px-4 text-slate-400 hover:bg-white/10 hover:text-slate-100 rounded-xl' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 py-2.5 text-sm font-medium transition-colors duration-150
                          {{ $route === 'dashboard'
                             ? 'pl-3 pr-4 border-l-4 border-red-500 bg-white/10 text-white rounded-r-xl font-semibold'
                             : 'px-4 text-slate-400 hover:bg-white/10 hover:text-slate-100 rounded-xl' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-3 py-2.5 text-sm font-medium transition-colors duration-150
                          {{ $route === 'profile.edit'
                             ? 'pl-3 pr-4 border-l-4 border-red-500 bg-white/10 text-white rounded-r-xl font-semibold'
                             : 'px-4 text-slate-400 hover:bg-white/10 hover:text-slate-100 rounded-xl' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    Profile
                </a>
            </li>
            <li>
                <a href="{{ route('courses.register') }}"
                   class="flex items-center gap-3 py-2.5 text-sm font-medium transition-colors duration-150
                          {{ $route === 'courses.register'
                             ? 'pl-3 pr-4 border-l-4 border-red-500 bg-white/10 text-white rounded-r-xl font-semibold'
                             : 'px-4 text-slate-400 hover:bg-white/10 hover:text-slate-100 rounded-xl' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    Courses
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center gap-3 py-2.5 px-4 text-slate-400 hover:bg-white/10 hover:text-slate-100 rounded-xl transition-colors duration-150 text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Settings
                </a>
            </li>
        </ul>

        {{-- Sign out --}}
        <div class="mt-auto pt-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 py-2.5 px-4 text-slate-400 hover:bg-white/10 hover:text-slate-100 rounded-xl transition-colors duration-150 text-sm font-medium text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- ── Main content ── --}}
    <div class="flex-1 min-w-0 overflow-x-hidden">
        <div class="p-4 sm:p-6 lg:p-8 max-w-screen-xl mx-auto">

            {{-- ── Welcome banner ── --}}
            <div class="relative overflow-hidden rounded-2xl mb-6 shadow-sm"
                 style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0f172a 100%);">
                {{-- decorative glows --}}
                <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 15% 50%, rgba(220,38,38,0.18) 0%, transparent 55%), radial-gradient(circle at 85% 20%, rgba(59,130,246,0.12) 0%, transparent 55%);"></div>
                <div class="relative px-6 py-7 sm:px-8">
                    <p class="text-red-400 text-xs font-bold uppercase tracking-widest mb-1.5">Academic Year 2025 / 2026</p>
                    <h1 class="text-white text-2xl sm:text-3xl font-bold leading-snug">
                        Welcome back, <span class="text-red-300">{{ auth()->user()->name }}</span>
                    </h1>
                    <p class="text-slate-400 text-sm mt-1.5">
                        {{ auth()->user()->program_taken ?? 'Student' }}
                        @if(auth()->user()->program_center)
                            &nbsp;&middot;&nbsp;{{ auth()->user()->program_center }}
                        @endif
                    </p>
                </div>
            </div>

            {{-- ── Quick-info stat row ── --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
                <div class="bg-white rounded-xl border border-slate-200 p-4 sm:p-5 db-stat-card shadow-sm">
                    <p class="db-label mb-1.5">Matric No.</p>
                    <p class="text-base font-bold text-slate-800 truncate">{{ auth()->user()->matric_number ?? '—' }}</p>
                </div>
                <div class="bg-white rounded-xl border border-slate-200 p-4 sm:p-5 db-stat-card shadow-sm">
                    <p class="db-label mb-1.5">Program</p>
                    <p class="text-base font-bold text-slate-800 truncate">{{ auth()->user()->program_taken ?? '—' }}</p>
                </div>
                <div class="bg-white rounded-xl border border-slate-200 p-4 sm:p-5 db-stat-card shadow-sm">
                    <p class="db-label mb-1.5">Study Center</p>
                    <p class="text-base font-bold text-slate-800 truncate">{{ auth()->user()->program_center ?? '—' }}</p>
                </div>
                <div class="bg-white rounded-xl border border-slate-200 p-4 sm:p-5 db-stat-card shadow-sm">
                    <p class="db-label mb-1.5">Year Admitted</p>
                    <p class="text-base font-bold text-slate-800 truncate">{{ auth()->user()->year_admitted ?? '—' }}</p>
                </div>
            </div>

            {{-- ── Profile + Academic row ── --}}
            <div class="grid lg:grid-cols-3 gap-4 mb-6">

                {{-- Profile card (2/3) --}}
                <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 p-5 sm:p-6 shadow-sm db-card flex items-center gap-5">
                    @if(auth()->user()->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                             alt="Profile Photo"
                             class="w-20 h-20 rounded-full object-cover db-avatar flex-shrink-0">
                    @else
                        <div class="w-20 h-20 rounded-full bg-red-50 border-2 border-red-200 flex items-center justify-center text-red-600 font-bold text-2xl flex-shrink-0 select-none">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif

                    <div class="min-w-0 flex-1">
                        <h2 class="text-lg font-bold text-slate-800 leading-tight">{{ auth()->user()->name }}</h2>
                        <p class="text-sm text-slate-400 mt-0.5 truncate">{{ auth()->user()->email }}</p>
                        <div class="flex flex-wrap gap-2 mt-3">
                            @if(auth()->user()->program_taken)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-red-50 text-red-700 text-xs font-semibold border border-red-200">
                                {{ auth()->user()->program_taken }}
                            </span>
                            @endif
                            @if(auth()->user()->program_center)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-medium border border-slate-200">
                                {{ auth()->user()->program_center }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <a href="{{ route('profile.edit') }}"
                       class="hidden sm:inline-flex flex-shrink-0 items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-red-600 transition-colors border border-slate-200 hover:border-red-300 rounded-lg px-3 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                        </svg>
                        Edit
                    </a>
                </div>

                {{-- Academic standing card (1/3) --}}
                <div class="bg-white rounded-xl border border-slate-200 p-5 sm:p-6 shadow-sm db-card">
                    <p class="db-label mb-4">Academic Standing</p>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-500">GPA</span>
                            <span class="text-sm font-bold text-slate-800">{{ auth()->user()->gpa ?? '—' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-500">CGPA</span>
                            <span class="text-sm font-bold text-slate-800">{{ auth()->user()->cgpa ?? '—' }}</span>
                        </div>
                        <div class="pt-1">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs text-slate-400">Completion</span>
                                <span class="text-xs font-bold text-red-600">80%</span>
                            </div>
                            <div class="db-track">
                                <div class="db-fill" style="width:80%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 px-4 py-3 rounded-xl text-sm font-medium" style="background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0;">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('info'))
                <div class="mb-6 px-4 py-3 rounded-xl text-sm font-medium" style="background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;">
                    {{ session('info') }}
                </div>
            @endif

            {{-- ── Course registration prompt ── --}}
            @php $currentLevel = auth()->user()->currentLevel(); @endphp
            @if($currentLevel && ! auth()->user()->hasRegisteredCoursesForLevel($currentLevel))
                <div class="mb-6 rounded-xl border border-amber-200 bg-amber-50 px-5 py-4 flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-bold text-amber-800">Course registration pending</p>
                        <p class="text-xs text-amber-700 mt-0.5">You have not registered your courses for {{ \App\Models\Course::levelLabel($currentLevel) }} yet.</p>
                    </div>
                    <a href="{{ route('courses.register') }}"
                       class="flex-shrink-0 inline-flex items-center gap-1.5 text-xs font-bold text-white rounded-lg px-4 py-2.5 transition-opacity hover:opacity-90"
                       style="background:#dc2626;">
                        Register Courses
                    </a>
                </div>
            @endif

            {{-- ── Enrolled Courses table ── --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm db-card mb-6 overflow-hidden">
                <div class="px-5 sm:px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Registered Courses</h3>
                        <p class="text-xs text-slate-400 mt-0.5">{{ auth()->user()->programLabel() ?? 'Your programme' }}</p>
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <span class="text-xs font-semibold bg-red-50 text-red-700 border border-red-200 px-2.5 py-1 rounded-full">
                            {{ auth()->user()->courses->count() }} {{ Str::plural('course', auth()->user()->courses->count()) }}
                        </span>
                        @if($currentLevel && auth()->user()->hasRegisteredCoursesForLevel($currentLevel))
                            <span class="inline-flex items-center gap-1 text-xs font-semibold bg-slate-100 text-slate-500 border border-slate-200 px-2.5 py-1 rounded-full"
                                  title="Course registration for {{ \App\Models\Course::levelLabel($currentLevel) }} is locked. Contact the college office for corrections.">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                                Locked
                            </span>
                        @else
                            <a href="{{ route('courses.register') }}"
                               class="text-xs font-semibold text-slate-500 hover:text-red-600 transition-colors border border-slate-200 hover:border-red-300 rounded-lg px-3 py-1.5">
                                Register Courses
                            </a>
                        @endif
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="db-table">
                        <thead>
                            <tr>
                                <th>Course Title</th>
                                <th>Code</th>
                                <th>Lecturer</th>
                                <th>Level</th>
                                <th>Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(auth()->user()->courses->sortBy(fn ($c) => [$c->pivot->level, $c->semester]) as $course)
                                <tr>
                                    <td class="font-medium text-slate-700">{{ $course->title }}</td>
                                    <td>
                                        <span style="font-family:monospace;font-size:0.78rem;background:#f1f5f9;color:#475569;padding:2px 8px;border-radius:6px;border:1px solid #e2e8f0;">
                                            {{ $course->code ?: '—' }}
                                        </span>
                                    </td>
                                    <td>{{ $course->instructor && $course->instructor !== 'TBA' ? $course->instructor : 'TBA' }}</td>
                                    <td>{{ $course->pivot->level ?? '—' }}</td>
                                    <td>
                                        <span style="display:inline-flex;align-items:center;justify-content:center;min-width:1.75rem;height:1.75rem;border-radius:50%;background:#fef2f2;color:#b91c1c;font-size:0.78rem;font-weight:700;border:1px solid #fecaca;padding:0 0.3rem;">
                                            {{ $course->unit !== null ? rtrim(rtrim(number_format((float) $course->unit, 1), '0'), '.') : '—' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align:center;padding:2.5rem 1rem;color:#94a3b8;font-size:0.875rem;">
                                        No courses registered yet.
                                        <a href="{{ route('courses.register') }}" style="color:#dc2626;font-weight:600;">Register your courses</a>.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ── My Results ── --}}
            @php
                $resultSheets = auth()->user()->results()
                    ->orderBy('session')->orderBy('level')->get()
                    ->groupBy(fn ($r) => $r->session . '|' . $r->level);
            @endphp
            @if($resultSheets->isNotEmpty())
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm db-card mb-6 overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800">My Results</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Life College of Theology, Abuja — Session's Result</p>
                    </div>
                    <div class="p-5 sm:p-6 space-y-6">
                        @foreach($resultSheets as $key => $sheet)
                            @php [$sheetSession, $sheetLevel] = explode('|', $key); @endphp
                            <div>
                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">{{ $sheetSession }} Session</span>
                                    <span class="text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-full">{{ ucfirst(\App\Models\Course::levelLabel($sheetLevel)) }}</span>
                                </div>
                                @foreach($sheet->groupBy('semester')->sortBy(fn ($rows, $sem) => array_search($sem, \App\Models\Course::SEMESTER_ORDER)) as $semester => $rows)
                                    <div class="overflow-x-auto mb-4">
                                        <table class="db-table">
                                            <thead>
                                                <tr>
                                                    <th style="width:3rem;">#</th>
                                                    <th>{{ $semester }}</th>
                                                    <th style="width:7rem;">Scores %</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($rows->values() as $i => $result)
                                                    <tr>
                                                        <td style="color:#94a3b8;">{{ $i + 1 }}</td>
                                                        <td class="font-medium text-slate-700">{{ $result->course_title }}</td>
                                                        <td class="font-bold" style="color:{{ $result->score >= 50 ? '#065f46' : '#b91c1c' }};">
                                                            {{ rtrim(rtrim(number_format((float) $result->score, 2), '0'), '.') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- ── Timetables ── --}}
            <div class="grid lg:grid-cols-2 gap-4 mb-6">

                {{-- Course timetable --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm db-card overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-7 h-7 rounded-lg bg-red-50 border border-red-200 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#dc2626" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-800">Course Timetable</h3>
                            <p class="text-xs text-slate-400">Lecture schedule</p>
                        </div>
                    </div>
                    @include('partials.timetable', ['raw' => auth()->user()->course_timetable, 'timeLabel' => 'Time'])
                </div>

                {{-- Exam timetable --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm db-card overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-7 h-7 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#64748b" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-800">Exam Timetable</h3>
                            <p class="text-xs text-slate-400">Examination schedule</p>
                        </div>
                    </div>
                    @include('partials.timetable', ['raw' => auth()->user()->exam_timetable, 'timeLabel' => 'Date & Time'])
                </div>
            </div>

        </div>{{-- /inner padded div --}}
    </div>{{-- /main --}}
</div>{{-- /outer flex --}}
</x-app-layout>
