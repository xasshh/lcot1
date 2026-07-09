<x-admin-layout>
    <x-slot name="title">Timetables</x-slot>

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.timetable.index') }}"
          style="display:flex;gap:0.75rem;margin-bottom:1.25rem;align-items:flex-end;flex-wrap:wrap;">
        <div class="adm-search-wrap" style="flex:1;max-width:400px;min-width:200px;">
            <span class="adm-search-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input type="text" name="search" value="{{ request('search') }}"
                   class="adm-input adm-search-input" placeholder="Search by name or matric…">
        </div>
        <button type="submit" class="adm-btn adm-btn-primary">Search</button>
        @if(request('search'))
            <a href="{{ route('admin.timetable.index') }}" class="adm-btn adm-btn-secondary">Clear</a>
        @endif
    </form>

    <div class="adm-card">
        <div class="adm-card-header">
            <div class="adm-card-title">Student Timetables</div>
            <div style="font-size:0.78rem;color:#94a3b8;">Click Edit to fill in the Monday–Saturday grid</div>
        </div>
        <div style="overflow-x:auto;">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Matric No.</th>
                        <th>Course Timetable</th>
                        <th>Exam Timetable</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        @php
                            $courseGrid = \App\Support\Timetable::decode($student->course_timetable);
                            $examGrid   = \App\Support\Timetable::decode($student->exam_timetable);
                            $payload = [
                                'id'            => $student->id,
                                'name'          => $student->name,
                                'course'        => $courseGrid,
                                'exam'          => $examGrid,
                                'legacy_course' => $courseGrid ? null : $student->course_timetable,
                                'legacy_exam'   => $examGrid ? null : $student->exam_timetable,
                            ];
                        @endphp
                        <tr>
                            <td style="font-weight:600;color:#1e293b;">{{ $student->name }}</td>
                            <td><span style="font-family:monospace;font-size:0.8rem;color:#475569;">{{ $student->matric_number ?? '—' }}</span></td>
                            <td>
                                @if($courseGrid)
                                    <span class="adm-badge adm-badge-green">{{ count(\App\Support\Timetable::filledDays($courseGrid)) }} {{ Str::plural('day', count(\App\Support\Timetable::filledDays($courseGrid))) }} set</span>
                                @elseif($student->course_timetable)
                                    <span class="adm-badge adm-badge-amber">Legacy text</span>
                                @else
                                    <span style="color:#cbd5e1;font-size:0.8rem;">Not set</span>
                                @endif
                            </td>
                            <td>
                                @if($examGrid)
                                    <span class="adm-badge adm-badge-green">{{ count(\App\Support\Timetable::filledDays($examGrid)) }} {{ Str::plural('day', count(\App\Support\Timetable::filledDays($examGrid))) }} set</span>
                                @elseif($student->exam_timetable)
                                    <span class="adm-badge adm-badge-amber">Legacy text</span>
                                @else
                                    <span style="color:#cbd5e1;font-size:0.8rem;">Not set</span>
                                @endif
                            </td>
                            <td style="text-align:right;">
                                <button type="button"
                                        data-tt="{{ json_encode($payload) }}"
                                        onclick="openTimetableModal(this)"
                                        class="adm-btn adm-btn-secondary adm-btn-sm">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;padding:2.5rem;color:#94a3b8;">
                                No students found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($students->hasPages())
            <div style="padding:1rem 1.5rem;border-top:1px solid #f1f5f9;">
                {{ $students->links() }}
            </div>
        @endif
    </div>

    {{-- Timetable edit modal --}}
    <div id="ttModal" class="adm-modal-overlay" style="display:none;">
        <div class="adm-modal" style="max-width:860px;">
            <div class="adm-modal-header">
                <div class="adm-modal-title" id="ttModalName">Edit Timetable</div>
                <button class="adm-modal-close" onclick="closeTTModal()">
                    <svg style="width:1.25rem;height:1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form id="ttForm" method="POST">
                @csrf
                @method('PUT')
                <div class="adm-modal-body" style="max-height:70vh;overflow-y:auto;">

                    <div id="ttLegacyNote" style="display:none;padding:0.75rem 1rem;background:#fffbeb;border:1px solid #fde68a;border-radius:0.5rem;font-size:0.78rem;color:#92400e;margin-bottom:1.25rem;">
                        This student has an old free-text timetable. It is shown below for reference and will be
                        <strong>replaced by the grid</strong> when you save.
                        <pre id="ttLegacyText" style="margin:0.5rem 0 0;white-space:pre-wrap;font-size:0.72rem;color:#78350f;"></pre>
                    </div>

                    @foreach(['course' => ['Course Timetable', 'Time', 'Course / Subject'], 'exam' => ['Exam Timetable', 'Date & Time', 'Course / Paper']] as $section => [$heading, $timeLabel, $courseLabel])
                        <div style="margin-bottom:{{ $section === 'course' ? '1.75rem' : '0.25rem' }};">
                            <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:{{ $section === 'course' ? '#dc2626' : '#64748b' }};margin-bottom:0.6rem;">
                                {{ $heading }}
                            </div>
                            <div style="overflow-x:auto;border:1px solid #e2e8f0;border-radius:0.5rem;">
                                <table class="adm-table" style="min-width:560px;">
                                    <thead>
                                        <tr>
                                            <th style="width:7.5rem;">Day</th>
                                            <th>{{ $timeLabel }}</th>
                                            <th>{{ $courseLabel }}</th>
                                            <th>Venue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(\App\Support\Timetable::DAYS as $day)
                                            <tr>
                                                <td style="font-weight:600;color:#1e293b;white-space:nowrap;">{{ $day }}</td>
                                                <td><input type="text" name="{{ $section }}[{{ $day }}][time]" class="adm-input" style="min-width:8rem;" placeholder="e.g. 9:00 – 11:00"></td>
                                                <td><input type="text" name="{{ $section }}[{{ $day }}][course]" class="adm-input" style="min-width:11rem;" placeholder="e.g. Hermeneutics"></td>
                                                <td><input type="text" name="{{ $section }}[{{ $day }}][venue]" class="adm-input" style="min-width:7rem;" placeholder="e.g. Hall A"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach

                    <p style="font-size:0.75rem;color:#94a3b8;margin:1rem 0 0;">
                        Leave a day's row blank if there is nothing scheduled — blank days are hidden on the student's phone view.
                    </p>
                </div>
                <div class="adm-modal-footer">
                    <button type="button" class="adm-btn adm-btn-secondary" onclick="closeTTModal()">Cancel</button>
                    <button type="submit" class="adm-btn adm-btn-primary">Save Timetable</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    var ttBase = '{{ url('/admin/timetable') }}';
    var ttDays = @json(\App\Support\Timetable::DAYS);
    var ttFields = @json(\App\Support\Timetable::FIELDS);

    function openTimetableModal(btn) {
        var data = JSON.parse(btn.dataset.tt);
        document.getElementById('ttForm').action = ttBase + '/' + data.id;
        document.getElementById('ttModalName').textContent = 'Timetable — ' + data.name;

        ['course', 'exam'].forEach(function (section) {
            ttDays.forEach(function (day) {
                ttFields.forEach(function (field) {
                    var input = document.querySelector('[name="' + section + '[' + day + '][' + field + ']"]');
                    input.value = (data[section] && data[section][day]) ? (data[section][day][field] || '') : '';
                });
            });
        });

        var legacy = [data.legacy_course, data.legacy_exam].filter(Boolean).join('\n\n');
        document.getElementById('ttLegacyNote').style.display = legacy ? 'block' : 'none';
        document.getElementById('ttLegacyText').textContent = legacy;

        document.getElementById('ttModal').style.display = 'flex';
    }
    function closeTTModal() {
        document.getElementById('ttModal').style.display = 'none';
    }
    document.getElementById('ttModal').addEventListener('click', function(e) {
        if (e.target === this) closeTTModal();
    });
    </script>
</x-admin-layout>
