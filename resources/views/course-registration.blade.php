<x-app-layout>
<div class="min-h-screen py-8 px-4" style="background:#f1f5f9;">
    <div class="max-w-3xl mx-auto">

        {{-- Header --}}
        <div class="relative overflow-hidden rounded-2xl mb-6 shadow-sm"
             style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0f172a 100%);">
            <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 15% 50%, rgba(220,38,38,0.18) 0%, transparent 55%);"></div>
            <div class="relative px-6 py-6 sm:px-8">
                <p class="text-red-400 text-xs font-bold uppercase tracking-widest mb-1.5">Course Registration</p>
                <h1 class="text-white text-xl sm:text-2xl font-bold leading-snug">
                    {{ $program ? \App\Models\Course::PROGRAMS[$program] : 'Select Your Programme' }}
                </h1>
                @if($program && $level)
                    <p class="text-slate-400 text-sm mt-1">{{ ucfirst(\App\Models\Course::levelLabel($level)) }} — tick the courses you are taking, then submit.</p>
                @endif
            </div>
        </div>

        @if(session('success'))
            <div class="mb-5 px-4 py-3 rounded-lg text-sm font-medium" style="background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-5 px-4 py-3 rounded-lg text-sm" style="background:rgba(220,38,38,0.08);border:1px solid rgba(220,38,38,0.35);color:#dc2626;">
                <ul class="m-0 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(! $program)
            {{-- Students choose their programme track here before registering courses --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <h2 class="text-base font-bold text-slate-800 mb-1">Choose your programme track</h2>
                <p class="text-sm text-slate-500 mb-5">Select the programme you are taking — this loads the right course lists for your registration. You only do this once.</p>
                <form method="POST" action="{{ route('courses.register.store') }}" class="space-y-3">
                    @csrf
                    @foreach(\App\Models\Course::PROGRAMS as $key => $label)
                        <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 hover:border-red-300 cursor-pointer transition-colors">
                            <input type="radio" name="program" value="{{ $key }}" required class="accent-red-600 w-4 h-4">
                            <span class="text-sm font-semibold text-slate-700">{{ $label }}</span>
                        </label>
                    @endforeach
                    <button type="submit"
                            class="w-full mt-2 py-3 rounded-xl text-sm font-bold text-white transition-opacity hover:opacity-90"
                            style="background:#dc2626;">
                        Continue
                    </button>
                </form>
            </div>
        @else
            {{-- One-shot warning --}}
            <div class="mb-5 rounded-xl border border-amber-200 bg-amber-50 px-5 py-4">
                <p class="text-sm font-bold text-amber-800">Please review carefully before submitting</p>
                <p class="text-xs text-amber-700 mt-0.5">
                    Course registration can only be submitted <strong>once per level</strong>.
                    After submission your selection is locked and cannot be edited — contact the college office to correct a mistake.
                </p>
            </div>

            <form method="POST" action="{{ route('courses.register.store') }}"
                  onsubmit="return confirm('Submit your {{ \App\Models\Course::levelLabel($level) }} course registration? This cannot be changed afterwards.')">
                @csrf
                <input type="hidden" name="level" value="{{ $level }}">

                @forelse($coursesByGroup as $semester => $courses)
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm mb-5 overflow-hidden">
                        <div class="px-5 py-3.5 border-b border-slate-100" style="background:#1e293b;">
                            <h3 class="text-xs font-bold text-white uppercase tracking-widest">{{ $semester }}</h3>
                        </div>
                        <div class="divide-y divide-slate-100">
                            @foreach($courses as $course)
                                <label class="flex items-center gap-4 px-5 py-3.5 hover:bg-slate-50 cursor-pointer transition-colors">
                                    <input type="checkbox" name="course_ids[]" value="{{ $course->id }}"
                                           class="accent-red-600 w-4 h-4 flex-shrink-0"
                                           {{ in_array($course->id, old('course_ids', [])) ? 'checked' : '' }}>
                                    <span class="flex-1 min-w-0">
                                        <span class="block text-sm font-semibold text-slate-700">{{ $course->title }}</span>
                                        <span class="block text-xs text-slate-400 mt-0.5">
                                            @if($course->code)<span style="font-family:monospace;">{{ $course->code }}</span> &middot; @endif
                                            {{ $course->instructor && $course->instructor !== 'TBA' ? $course->instructor : 'Lecturer TBA' }}
                                        </span>
                                    </span>
                                    <span class="flex-shrink-0 text-xs font-bold text-red-700 bg-red-50 border border-red-200 rounded-full px-2.5 py-1">
                                        {{ rtrim(rtrim(number_format((float) $course->unit, 1), '0'), '.') }} {{ Str::plural('unit', (float) $course->unit) }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-8 text-center text-sm text-slate-400 mb-5">
                        No courses have been published for this level yet. Please check back later or contact the college office.
                    </div>
                @endforelse

                @if($coursesByGroup->isNotEmpty())
                    <button type="submit"
                            class="w-full py-3.5 rounded-xl text-sm font-bold text-white transition-opacity hover:opacity-90"
                            style="background:#dc2626;">
                        Submit Course Registration
                    </button>
                    <p class="text-xs text-slate-400 text-center mt-3">
                        Submitting locks your {{ \App\Models\Course::levelLabel($level) }} course selection — it cannot be edited afterwards.
                    </p>
                @endif
            </form>
        @endif

        <div class="mt-6 text-center">
            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-slate-500 hover:text-red-600 transition-colors">
                &larr; Back to Dashboard
            </a>
        </div>
    </div>
</div>
</x-app-layout>
