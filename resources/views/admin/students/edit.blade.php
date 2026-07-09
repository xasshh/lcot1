<x-admin-layout>
    <x-slot name="title">Edit Student</x-slot>

    <div style="max-width:860px;">
        <div style="margin-bottom:1.25rem;">
            <a href="{{ route('admin.students.index') }}" class="adm-btn adm-btn-secondary adm-btn-sm">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Students
            </a>
        </div>

        <form method="POST" action="{{ route('admin.students.update', $student) }}">
            @csrf
            @method('PUT')

            <div class="adm-grid-2">

                {{-- Personal Info --}}
                <div class="adm-card">
                    <div class="adm-card-header">
                        <div class="adm-card-title">Personal Information</div>
                    </div>
                    <div class="adm-card-body">
                        <div class="adm-form-group">
                            <label class="adm-label">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $student->name) }}"
                                   class="adm-input" required>
                            @error('name')<div class="adm-error-text">{{ $message }}</div>@enderror
                        </div>
                        <div class="adm-form-group">
                            <label class="adm-label">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $student->email) }}"
                                   class="adm-input" required>
                            @error('email')<div class="adm-error-text">{{ $message }}</div>@enderror
                        </div>
                        <div class="adm-form-group">
                            <label class="adm-label">Matric Number</label>
                            <input type="text" name="matric_number"
                                   value="{{ old('matric_number', $student->matric_number) }}"
                                   class="adm-input">
                            @error('matric_number')<div class="adm-error-text">{{ $message }}</div>@enderror
                        </div>
                        <div class="adm-form-group">
                            <label class="adm-label">Role</label>
                            <select name="role" class="adm-select" required>
                                @foreach(['student','staff','admin'] as $r)
                                    <option value="{{ $r }}" {{ old('role', $student->role) === $r ? 'selected' : '' }}>
                                        {{ ucfirst($r) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')<div class="adm-error-text">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- Academic Info --}}
                <div class="adm-card">
                    <div class="adm-card-header">
                        <div class="adm-card-title">Academic Details</div>
                    </div>
                    <div class="adm-card-body">
                        <div class="adm-form-group">
                            <label class="adm-label">Program Center</label>
                            <input type="text" name="program_center"
                                   value="{{ old('program_center', $student->program_center) }}"
                                   class="adm-input">
                            @error('program_center')<div class="adm-error-text">{{ $message }}</div>@enderror
                        </div>
                        <div class="adm-form-group">
                            <label class="adm-label">Program Taken</label>
                            <input type="text" name="program_taken"
                                   value="{{ old('program_taken', $student->program_taken) }}"
                                   class="adm-input">
                            @error('program_taken')<div class="adm-error-text">{{ $message }}</div>@enderror
                        </div>
                        <div class="adm-form-group">
                            <label class="adm-label">Year Admitted</label>
                            <input type="number" name="year_admitted"
                                   value="{{ old('year_admitted', $student->year_admitted) }}"
                                   class="adm-input" min="2000" max="2030">
                            @error('year_admitted')<div class="adm-error-text">{{ $message }}</div>@enderror
                        </div>
                        <div class="adm-form-group">
                            <label class="adm-label">Level</label>
                            <input type="text" name="level"
                                   value="{{ old('level', $student->level) }}"
                                   class="adm-input" placeholder="e.g. 200">
                            @error('level')<div class="adm-error-text">{{ $message }}</div>@enderror
                        </div>
                        <div class="adm-grid-2" style="gap:0.75rem;">
                            <div class="adm-form-group">
                                <label class="adm-label">GPA</label>
                                <input type="number" name="gpa"
                                       value="{{ old('gpa', $student->gpa) }}"
                                       class="adm-input" step="0.01" min="0" max="5">
                                @error('gpa')<div class="adm-error-text">{{ $message }}</div>@enderror
                            </div>
                            <div class="adm-form-group">
                                <label class="adm-label">CGPA</label>
                                <input type="number" name="cgpa"
                                       value="{{ old('cgpa', $student->cgpa) }}"
                                       class="adm-input" step="0.01" min="0" max="5">
                                @error('cgpa')<div class="adm-error-text">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="adm-form-group">
                            <label class="adm-label">Tuition Balance (₦)</label>
                            <input type="number" name="tuition_balance"
                                   value="{{ old('tuition_balance', $student->tuition_balance) }}"
                                   class="adm-input" step="0.01" min="0">
                            @error('tuition_balance')<div class="adm-error-text">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- Course Assignment --}}
                <div class="adm-card" style="grid-column:span 2;">
                    <div class="adm-card-header">
                        <div class="adm-card-title">Course Assignment</div>
                        <div style="font-size:0.78rem;color:#94a3b8;">Hold Ctrl/Cmd to select multiple</div>
                    </div>
                    <div class="adm-card-body">
                        @if($courses->isEmpty())
                            <p style="color:#94a3b8;font-size:0.85rem;">No courses available. <a href="{{ route('admin.courses.index') }}" style="color:#f59e0b;">Add courses first.</a></p>
                        @else
                            <div class="adm-grid-3" style="gap:0.5rem;">
                                @foreach($courses as $course)
                                    <label style="display:flex;align-items:center;gap:0.5rem;padding:0.5rem 0.75rem;border:1px solid #e2e8f0;border-radius:0.5rem;cursor:pointer;font-size:0.82rem;color:#374151;background:{{ in_array($course->id, $assignedIds) ? '#fef3c7' : '#fff' }};">
                                        <input type="checkbox" name="course_ids[]" value="{{ $course->id }}"
                                               {{ in_array($course->id, $assignedIds) ? 'checked' : '' }}
                                               style="accent-color:#f59e0b;">
                                        <div>
                                            <div style="font-weight:600;">{{ $course->title }}</div>
                                            <div style="font-size:0.72rem;color:#94a3b8;">{{ $course->code }} &bull; {{ $course->unit }}u</div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <div style="margin-top:1.5rem;display:flex;gap:0.75rem;">
                <button type="submit" class="adm-btn adm-btn-primary">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Save Changes
                </button>
                <a href="{{ route('admin.students.index') }}" class="adm-btn adm-btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-admin-layout>
