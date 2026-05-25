<x-admin-layout>
    <x-slot name="title">Courses</x-slot>

    <div style="display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start;">

        {{-- Course list --}}
        <div class="adm-card">
            <div class="adm-card-header">
                <div class="adm-card-title">
                    All Courses
                    <span class="adm-badge adm-badge-slate" style="margin-left:0.5rem;">{{ $courses->total() }}</span>
                </div>
            </div>
            <div style="overflow-x:auto;">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Code</th>
                            <th>Instructor</th>
                            <th>Units</th>
                            <th>Students</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr>
                                <td style="font-weight:600;color:#1e293b;">{{ $course->title }}</td>
                                <td><span style="font-family:monospace;font-size:0.8rem;color:#475569;">{{ $course->code }}</span></td>
                                <td style="color:#64748b;">{{ $course->instructor ?? '—' }}</td>
                                <td><span class="adm-badge adm-badge-amber">{{ $course->unit }}u</span></td>
                                <td><span class="adm-badge adm-badge-slate">{{ $course->students_count }}</span></td>
                                <td style="text-align:right;white-space:nowrap;">
                                    <button type="button"
                                            onclick="openEditModal({{ $course->id }}, '{{ addslashes($course->title) }}', '{{ addslashes($course->code) }}', '{{ addslashes($course->instructor ?? '') }}', {{ $course->unit }})"
                                            class="adm-btn adm-btn-secondary adm-btn-sm">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('admin.courses.destroy', $course) }}"
                                          style="display:inline;"
                                          onsubmit="return confirm('Delete course {{ addslashes($course->title) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center;padding:2.5rem;color:#94a3b8;">
                                    No courses yet. Add your first course.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($courses->hasPages())
                <div style="padding:1rem 1.5rem;border-top:1px solid #f1f5f9;">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>

        {{-- Add course form --}}
        <div class="adm-card">
            <div class="adm-card-header">
                <div class="adm-card-title">Add New Course</div>
            </div>
            <div class="adm-card-body">
                <form method="POST" action="{{ route('admin.courses.store') }}">
                    @csrf
                    <div class="adm-form-group">
                        <label class="adm-label">Course Title</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               class="adm-input" required placeholder="e.g. Introduction to Theology">
                        @error('title')<div class="adm-error-text">{{ $message }}</div>@enderror
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Course Code</label>
                        <input type="text" name="code" value="{{ old('code') }}"
                               class="adm-input" required placeholder="e.g. TH101">
                        @error('code')<div class="adm-error-text">{{ $message }}</div>@enderror
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Instructor</label>
                        <input type="text" name="instructor" value="{{ old('instructor') }}"
                               class="adm-input" placeholder="Instructor name">
                        @error('instructor')<div class="adm-error-text">{{ $message }}</div>@enderror
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Credit Units</label>
                        <select name="unit" class="adm-select" required>
                            @foreach([1,2,3,4,6] as $u)
                                <option value="{{ $u }}" {{ old('unit') == $u ? 'selected' : '' }}>{{ $u }}</option>
                            @endforeach
                        </select>
                        @error('unit')<div class="adm-error-text">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="adm-btn adm-btn-primary" style="width:100%;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Course
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit modal --}}
    <div id="editModal" class="adm-modal-overlay" style="display:none;">
        <div class="adm-modal">
            <div class="adm-modal-header">
                <div class="adm-modal-title">Edit Course</div>
                <button class="adm-modal-close" onclick="closeEditModal()">
                    <svg style="width:1.25rem;height:1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="adm-modal-body">
                    <div class="adm-form-group">
                        <label class="adm-label">Course Title</label>
                        <input type="text" id="editTitle" name="title" class="adm-input" required>
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Course Code</label>
                        <input type="text" id="editCode" name="code" class="adm-input" required>
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Instructor</label>
                        <input type="text" id="editInstructor" name="instructor" class="adm-input">
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Credit Units</label>
                        <select id="editUnit" name="unit" class="adm-select" required>
                            @foreach([1,2,3,4,6] as $u)
                                <option value="{{ $u }}">{{ $u }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="adm-modal-footer">
                    <button type="button" class="adm-btn adm-btn-secondary" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="adm-btn adm-btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    var baseUrl = '{{ url('/admin/courses') }}';
    function openEditModal(id, title, code, instructor, unit) {
        document.getElementById('editForm').action = baseUrl + '/' + id;
        document.getElementById('editTitle').value = title;
        document.getElementById('editCode').value = code;
        document.getElementById('editInstructor').value = instructor;
        document.getElementById('editUnit').value = unit;
        document.getElementById('editModal').style.display = 'flex';
    }
    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });
    </script>
</x-admin-layout>
