<x-admin-layout>
    <x-slot name="title">Upload Result</x-slot>

    <div style="max-width:820px;">

        <a href="{{ route('admin.results.index') }}"
           style="display:inline-flex;align-items:center;gap:0.35rem;font-size:0.8rem;font-weight:600;color:#64748b;text-decoration:none;margin-bottom:1rem;">
            &larr; Back to Results
        </a>

        {{-- Session / level picker (GET reload) --}}
        <div class="adm-card" style="margin-bottom:1.25rem;">
            <div class="adm-card-body" style="padding:1rem 1.5rem;">
                <form method="GET" action="{{ route('admin.results.create', $student) }}"
                      style="display:flex;gap:1rem;flex-wrap:wrap;align-items:flex-end;">
                    <div style="flex:1;min-width:160px;">
                        <label class="adm-label">Session (Year)</label>
                        <input type="text" name="session" value="{{ $session }}" class="adm-input" placeholder="e.g. 2025/2026">
                    </div>
                    <div style="flex:1;min-width:140px;">
                        <label class="adm-label">Level</label>
                        <select name="level" class="adm-select">
                            @foreach($levels as $lvl)
                                <option value="{{ $lvl }}" {{ $lvl === $level ? 'selected' : '' }}>{{ $lvl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="adm-btn adm-btn-secondary">Load Sheet</button>
                </form>
            </div>
        </div>

        {{-- Result sheet — mirrors the RESULT CHECK LIST document --}}
        <div class="adm-card">
            <div style="text-align:center;padding:1.5rem 1.5rem 1rem;border-bottom:1px solid #f1f5f9;">
                <div style="font-size:1rem;font-weight:800;color:#1e293b;letter-spacing:0.04em;">LIFE COLLEGE OF THEOLOGY, ABUJA</div>
                <div style="font-size:0.8rem;font-weight:700;color:#64748b;letter-spacing:0.1em;text-transform:uppercase;margin-top:0.25rem;">Session's Result</div>
                <div style="display:flex;justify-content:center;gap:2rem;flex-wrap:wrap;margin-top:0.9rem;font-size:0.83rem;color:#374151;">
                    <span><strong>Name of Student:</strong> {{ $student->name }}</span>
                    <span><strong>Matric No:</strong> {{ $student->matric_number ?? '—' }}</span>
                    <span><strong>Year:</strong> {{ $session }}</span>
                    <span><strong>Level:</strong> {{ $level }}</span>
                </div>
            </div>

            @if(! $program)
                <div style="padding:2rem 1.5rem;text-align:center;color:#94a3b8;font-size:0.875rem;">
                    This student has no programme track set, so there is no course sheet to score.
                    Set their programme first (they can pick it on their course-registration page,
                    or you can edit their profile).
                    <div style="margin-top:1rem;">
                        <a href="{{ route('admin.students.edit', $student) }}" class="adm-btn adm-btn-secondary adm-btn-sm">Edit Student</a>
                    </div>
                </div>
            @elseif($coursesByGroup->isEmpty())
                <div style="padding:2rem 1.5rem;text-align:center;color:#94a3b8;font-size:0.875rem;">
                    No courses found for {{ \App\Models\Course::PROGRAMS[$program] }} at {{ $level }} level.
                    Run the course seeder or add the courses in the Courses section.
                </div>
            @else
                <form method="POST" action="{{ route('admin.results.store', $student) }}">
                    @csrf
                    <input type="hidden" name="session" value="{{ $session }}">
                    <input type="hidden" name="level" value="{{ $level }}">

                    <div class="adm-card-body">
                        @foreach($coursesByGroup as $semester => $courses)
                            <table class="adm-table" style="margin-bottom:1.5rem;">
                                <thead>
                                    <tr>
                                        <th style="width:3rem;">#</th>
                                        <th>{{ strtoupper($semester) }}</th>
                                        <th style="width:9rem;">Scores&nbsp;%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $i => $course)
                                        <tr>
                                            <td style="color:#94a3b8;">{{ $i + 1 }}</td>
                                            <td style="font-weight:600;color:#1e293b;">
                                                {{ $course->title }}
                                                @if($course->code)
                                                    <span style="font-family:monospace;font-size:0.72rem;color:#94a3b8;margin-left:0.4rem;">{{ $course->code }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="number" name="scores[{{ $course->id }}]"
                                                       value="{{ old('scores.' . $course->id, optional($existing->get($course->title))->score) }}"
                                                       min="0" max="100" step="0.01"
                                                       class="adm-input" style="max-width:7rem;" placeholder="—">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach

                        @error('scores')<div class="adm-error-text" style="margin-bottom:1rem;">{{ $message }}</div>@enderror
                        @error('scores.*')<div class="adm-error-text" style="margin-bottom:1rem;">{{ $message }}</div>@enderror

                        <p style="font-size:0.75rem;color:#94a3b8;margin:0 0 1.25rem;">
                            Leave a score blank to skip that course (a previously saved score will be removed).
                        </p>

                        <div style="display:flex;gap:0.75rem;align-items:center;">
                            <button type="submit" class="adm-btn adm-btn-primary">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                Save Result Sheet
                            </button>
                        </div>
                    </div>
                </form>

                @if($existing->isNotEmpty())
                    <div style="padding:1rem 1.5rem;border-top:1px solid #f1f5f9;">
                        <form method="POST" action="{{ route('admin.results.destroy', $student) }}"
                              onsubmit="return confirm('Delete the entire {{ $session }} / {{ $level }} level result sheet for {{ addslashes($student->name) }}?')">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="session" value="{{ $session }}">
                            <input type="hidden" name="level" value="{{ $level }}">
                            <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">Delete This Result Sheet</button>
                        </form>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-admin-layout>
