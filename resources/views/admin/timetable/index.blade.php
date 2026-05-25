<x-admin-layout>
    <x-slot name="title">Timetables</x-slot>

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.timetable.index') }}"
          style="display:flex;gap:0.75rem;margin-bottom:1.25rem;align-items:flex-end;">
        <div class="adm-search-wrap" style="flex:1;max-width:400px;">
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
            <div style="font-size:0.78rem;color:#94a3b8;">Click Edit to update a student's timetable</div>
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
                        <tr>
                            <td style="font-weight:600;color:#1e293b;">{{ $student->name }}</td>
                            <td><span style="font-family:monospace;font-size:0.8rem;color:#475569;">{{ $student->matric_number ?? '—' }}</span></td>
                            <td style="max-width:220px;">
                                @if($student->course_timetable)
                                    <div style="font-size:0.78rem;color:#374151;white-space:pre-wrap;max-height:60px;overflow:hidden;text-overflow:ellipsis;">{{ Str::limit($student->course_timetable, 80) }}</div>
                                @else
                                    <span style="color:#cbd5e1;font-size:0.8rem;">Not set</span>
                                @endif
                            </td>
                            <td style="max-width:220px;">
                                @if($student->exam_timetable)
                                    <div style="font-size:0.78rem;color:#374151;white-space:pre-wrap;max-height:60px;overflow:hidden;text-overflow:ellipsis;">{{ Str::limit($student->exam_timetable, 80) }}</div>
                                @else
                                    <span style="color:#cbd5e1;font-size:0.8rem;">Not set</span>
                                @endif
                            </td>
                            <td style="text-align:right;">
                                <button type="button"
                                        onclick="openTimetableModal({{ $student->id }}, '{{ addslashes($student->name) }}', {{ json_encode($student->course_timetable) }}, {{ json_encode($student->exam_timetable) }})"
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
        <div class="adm-modal" style="max-width:620px;">
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
                <div class="adm-modal-body">
                    <p style="font-size:0.8rem;color:#64748b;margin-bottom:1rem;">
                        Enter the timetable as plain text — one line per entry, e.g.<br>
                        <code style="background:#f1f5f9;padding:0.1rem 0.3rem;border-radius:3px;font-size:0.75rem;">Mon 08:00 | Introduction to Theology | Room A</code>
                    </p>
                    <div class="adm-form-group">
                        <label class="adm-label">Course Timetable</label>
                        <textarea name="course_timetable" id="ttCourse" class="adm-textarea"
                                  placeholder="Enter course schedule…" rows="5"></textarea>
                    </div>
                    <div class="adm-form-group" style="margin-bottom:0;">
                        <label class="adm-label">Exam Timetable</label>
                        <textarea name="exam_timetable" id="ttExam" class="adm-textarea"
                                  placeholder="Enter exam schedule…" rows="5"></textarea>
                    </div>
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
    function openTimetableModal(id, name, course, exam) {
        document.getElementById('ttForm').action = ttBase + '/' + id;
        document.getElementById('ttModalName').textContent = 'Timetable — ' + name;
        document.getElementById('ttCourse').value = course || '';
        document.getElementById('ttExam').value   = exam  || '';
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
