<x-app-layout>
<style>
    /* ── Profile premium theme — mirrors dashboard exactly ── */
    .db-sidebar {
        position: sticky;
        top: 0;
        height: 100vh;
        background: #0f172a;
        border-right: 1px solid rgba(255,255,255,0.06);
        overflow-y: auto;
    }
    .db-avatar {
        border: 3px solid #dc2626;
        transition: transform 0.25s ease;
    }
    .db-avatar:hover { transform: scale(1.06); }
    .db-card { transition: box-shadow 0.2s ease; }
    .db-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.07); }
    .db-label {
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #94a3b8;
    }
    .db-sidebar a:hover { color: inherit; text-decoration: none; }

    /* ── Profile-page form elements ── */
    .pf-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.375rem;
        letter-spacing: 0.02em;
    }
    .pf-input {
        width: 100%;
        padding: 0.625rem 0.875rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        color: #1e293b;
        background: #fff;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
        outline: none;
    }
    .pf-input:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220,38,38,0.1);
    }
    .pf-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.5rem 1.25rem;
        background: #dc2626;
        color: #fff;
        border: none;
        border-radius: 0.5rem;
        font-size: 0.8125rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.15s ease;
    }
    .pf-btn:hover { background: #b91c1c; }
    .pf-btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.5rem 1.25rem;
        background: transparent;
        color: #475569;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        font-size: 0.8125rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.15s ease;
    }
    .pf-btn-outline:hover { background: #f8fafc; }
    .pf-danger-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.5rem 1.25rem;
        background: transparent;
        color: #dc2626;
        border: 1px solid #fca5a5;
        border-radius: 0.5rem;
        font-size: 0.8125rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.15s ease;
    }
    .pf-danger-btn:hover { background: #fef2f2; }
</style>

<div class="flex min-h-screen" style="background:#f1f5f9;">

    {{-- ── Sidebar (desktop) — identical to dashboard ── --}}
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
                <a href="#"
                   class="flex items-center gap-3 py-2.5 px-4 text-slate-400 hover:bg-white/10 hover:text-slate-100 rounded-xl transition-colors duration-150 text-sm font-medium">
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

            {{-- ── Profile hero banner ── --}}
            <div class="relative overflow-hidden rounded-2xl mb-6 shadow-sm"
                 style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0f172a 100%);">
                <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 15% 50%, rgba(220,38,38,0.18) 0%, transparent 55%), radial-gradient(circle at 85% 20%, rgba(59,130,246,0.12) 0%, transparent 55%);"></div>
                <div class="relative px-6 py-7 sm:px-8 flex items-center gap-5">
                    @if(auth()->user()->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                             alt="Profile photo"
                             class="w-16 h-16 sm:w-20 sm:h-20 rounded-full object-cover flex-shrink-0"
                             style="border: 3px solid #dc2626;">
                    @else
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full flex-shrink-0 flex items-center justify-center text-white font-bold text-2xl"
                             style="background: linear-gradient(135deg, #dc2626, #9f1239); border: 3px solid rgba(220,38,38,0.5);">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="min-w-0">
                        <p class="text-red-400 text-xs font-bold uppercase tracking-widest mb-1.5">My Profile</p>
                        <h1 class="text-white text-xl sm:text-2xl font-bold leading-snug">{{ auth()->user()->name }}</h1>
                        <p class="text-slate-400 text-sm mt-1">
                            {{ auth()->user()->matric_number ?? 'No matric number' }}
                            @if(auth()->user()->program_taken)
                                &nbsp;&middot;&nbsp;{{ auth()->user()->program_taken }}
                            @endif
                            @if(auth()->user()->program_center)
                                &nbsp;&middot;&nbsp;{{ auth()->user()->program_center }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            {{-- Flash success message --}}
            @if(session('success'))
                <div class="mb-5 flex items-center gap-3 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- ── Row 1: Photo upload + Profile info ── --}}
            <div class="grid lg:grid-cols-2 gap-4 mb-4">

                {{-- ── Photo Upload Card ── --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm db-card overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-7 h-7 rounded-lg bg-red-50 border border-red-200 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#dc2626" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-800">Profile Photo</h3>
                            <p class="text-xs text-slate-400">JPG or PNG · max 2 MB</p>
                        </div>
                    </div>
                    <div class="p-5 sm:p-6">
                        {{-- Current photo preview --}}
                        <div class="flex items-center gap-4 mb-5 p-4 bg-slate-50 rounded-xl border border-slate-100">
                            @if(auth()->user()->profile_photo)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                                     alt="Current photo"
                                     class="w-16 h-16 rounded-full object-cover db-avatar flex-shrink-0">
                            @else
                                <div class="w-16 h-16 rounded-full bg-red-50 border-2 border-red-200 flex items-center justify-center text-red-600 font-bold text-xl select-none flex-shrink-0">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-slate-700 truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">
                                    {{ auth()->user()->profile_photo ? 'Photo on file — upload below to replace' : 'No photo yet — upload one below' }}
                                </p>
                            </div>
                        </div>

                        {{-- Upload form — enctype="multipart/form-data" is mandatory for file uploads --}}
                        <form method="POST"
                              action="{{ route('profile.uploadPhoto') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="pf-label" for="profile_photo">Choose new photo</label>
                                <input type="file"
                                       id="profile_photo"
                                       name="profile_photo"
                                       accept="image/jpeg,image/png"
                                       required
                                       class="block w-full text-sm text-slate-500
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-lg file:border-0
                                              file:text-xs file:font-semibold
                                              file:bg-red-50 file:text-red-700
                                              hover:file:bg-red-100
                                              cursor-pointer">
                                @error('profile_photo')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="pf-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                </svg>
                                Upload Photo
                            </button>
                        </form>
                    </div>
                </div>

                {{-- ── Profile Information Card ── --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm db-card overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-7 h-7 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#64748b" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-800">Profile Information</h3>
                            <p class="text-xs text-slate-400">Name and email address</p>
                        </div>
                    </div>
                    <div class="p-5 sm:p-6">
                        {{-- Hidden form used by the "resend verification" button --}}
                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                            @csrf
                            @method('patch')

                            <div>
                                <label class="pf-label" for="name">Full Name</label>
                                <input id="name" name="name" type="text"
                                       class="pf-input"
                                       value="{{ old('name', auth()->user()->name) }}"
                                       required autocomplete="name">
                                @error('name')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="pf-label" for="email">Email Address</label>
                                <input id="email" name="email" type="email"
                                       class="pf-input"
                                       value="{{ old('email', auth()->user()->email) }}"
                                       required autocomplete="username">
                                @error('email')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror

                                @if(auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                                    <p class="mt-2 text-xs text-amber-600">
                                        Your email is unverified.
                                        <button form="send-verification"
                                                class="underline font-semibold hover:text-amber-800 transition-colors">
                                            Resend verification email
                                        </button>
                                    </p>
                                    @if(session('status') === 'verification-link-sent')
                                        <p class="mt-1 text-xs text-emerald-600 font-medium">Verification link sent.</p>
                                    @endif
                                @endif
                            </div>

                            <div class="flex items-center gap-3 pt-1">
                                <button type="submit" class="pf-btn">Save Changes</button>
                                @if(session('status') === 'profile-updated')
                                    <span class="text-xs text-emerald-600 font-semibold">Saved.</span>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ── Row 2: Password + Danger Zone ── --}}
            <div class="grid lg:grid-cols-2 gap-4 mb-6">

                {{-- ── Update Password Card ── --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm db-card overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-7 h-7 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#64748b" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-800">Update Password</h3>
                            <p class="text-xs text-slate-400">Use a long, random password</p>
                        </div>
                    </div>
                    <div class="p-5 sm:p-6">
                        <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                            @csrf
                            @method('put')

                            <div>
                                <label class="pf-label" for="current_password">Current Password</label>
                                <input id="current_password" name="current_password" type="password"
                                       class="pf-input" autocomplete="current-password">
                                @error('current_password', 'updatePassword')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="pf-label" for="new_password">New Password</label>
                                <input id="new_password" name="password" type="password"
                                       class="pf-input" autocomplete="new-password">
                                @error('password', 'updatePassword')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="pf-label" for="password_confirmation">Confirm New Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                       class="pf-input" autocomplete="new-password">
                                @error('password_confirmation', 'updatePassword')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center gap-3 pt-1">
                                <button type="submit" class="pf-btn">Update Password</button>
                                @if(session('status') === 'password-updated')
                                    <span class="text-xs text-emerald-600 font-semibold">Updated.</span>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                {{-- ── Danger Zone Card ── --}}
                <div class="bg-white rounded-xl border border-red-100 shadow-sm overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-red-100 flex items-center gap-3">
                        <div class="w-7 h-7 rounded-lg bg-red-50 border border-red-200 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#dc2626" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-red-700">Danger Zone</h3>
                            <p class="text-xs text-red-400">Irreversible account actions</p>
                        </div>
                    </div>
                    <div class="p-5 sm:p-6">
                        <p class="text-sm text-slate-500 mb-5 leading-relaxed">
                            Once your account is deleted, all data and resources are permanently removed.
                            This action <strong class="text-slate-700">cannot be undone</strong>.
                        </p>
                        <button type="button"
                                class="pf-danger-btn"
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            Delete My Account
                        </button>
                    </div>
                </div>

            </div>
        </div>{{-- /inner padded div --}}
    </div>{{-- /main --}}
</div>{{-- /outer flex --}}

{{-- ── Delete account confirmation modal (Alpine.js x-modal component) ── --}}
<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-base font-bold text-slate-800">Delete your account?</h2>
        <p class="mt-1.5 text-sm text-slate-500">
            All data will be permanently deleted. Enter your password to confirm.
        </p>

        <div class="mt-5">
            <label class="pf-label" for="delete_password">Password</label>
            <input id="delete_password"
                   name="password"
                   type="password"
                   class="pf-input"
                   placeholder="Enter your current password">
            @error('password', 'userDeletion')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <button type="button" class="pf-btn-outline" x-on:click="$dispatch('close')">Cancel</button>
            <button type="submit" class="pf-btn">Delete Account</button>
        </div>
    </form>
</x-modal>
</x-app-layout>
