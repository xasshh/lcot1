<x-admin-layout>
    <x-slot name="title">Students</x-slot>

    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.students.index') }}"
          style="display:flex;gap:0.75rem;margin-bottom:1.25rem;flex-wrap:wrap;align-items:flex-end;">
        <div class="adm-search-wrap" style="flex:1;min-width:200px;">
            <span class="adm-search-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input type="text" name="search" value="{{ request('search') }}"
                   class="adm-input adm-search-input" placeholder="Search by name, matric, email…">
        </div>
        <select name="program_center" class="adm-select" style="width:200px;">
            <option value="">All Centers</option>
            @foreach($centers as $c)
                <option value="{{ $c }}" {{ request('program_center') === $c ? 'selected' : '' }}>
                    {{ ucfirst($c) }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="adm-btn adm-btn-primary">Filter</button>
        @if(request('search') || request('program_center'))
            <a href="{{ route('admin.students.index') }}" class="adm-btn adm-btn-secondary">Clear</a>
        @endif
    </form>

    <div class="adm-card">
        <div class="adm-card-header">
            <div class="adm-card-title">
                All Students
                <span class="adm-badge adm-badge-slate" style="margin-left:0.5rem;">{{ $students->total() }}</span>
            </div>
        </div>
        <div style="overflow-x:auto;">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Matric No.</th>
                        <th>Email</th>
                        <th>Center</th>
                        <th>Program</th>
                        <th>Year</th>
                        <th>GPA</th>
                        <th>Role</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td>
                                <div style="font-weight:600;color:#1e293b;">{{ $student->name }}</div>
                            </td>
                            <td>
                                <span style="font-family:monospace;font-size:0.8rem;color:#475569;">
                                    {{ $student->matric_number ?? '—' }}
                                </span>
                            </td>
                            <td style="color:#64748b;font-size:0.82rem;">{{ $student->email }}</td>
                            <td>
                                @if($student->program_center)
                                    <span class="adm-badge adm-badge-slate">{{ ucfirst($student->program_center) }}</span>
                                @else
                                    <span style="color:#cbd5e1;">—</span>
                                @endif
                            </td>
                            <td>
                                @if($student->program_taken)
                                    <span class="adm-badge adm-badge-amber">{{ $student->program_taken }}</span>
                                @else
                                    <span style="color:#cbd5e1;">—</span>
                                @endif
                            </td>
                            <td style="color:#64748b;">{{ $student->year_admitted ?? '—' }}</td>
                            <td>
                                @if($student->gpa)
                                    <span style="font-weight:700;color:{{ $student->gpa >= 3.5 ? '#065f46' : ($student->gpa >= 2.5 ? '#1d4ed8' : '#991b1b') }};">
                                        {{ number_format($student->gpa, 2) }}
                                    </span>
                                @else
                                    <span style="color:#cbd5e1;">—</span>
                                @endif
                            </td>
                            <td>
                                @php $roleColors = ['student'=>'adm-badge-slate','staff'=>'adm-badge-blue','admin'=>'adm-badge-amber']; @endphp
                                <span class="adm-badge {{ $roleColors[$student->role ?? 'student'] ?? 'adm-badge-slate' }}">
                                    {{ ucfirst($student->role ?? 'student') }}
                                </span>
                            </td>
                            <td style="text-align:right;white-space:nowrap;">
                                <a href="{{ route('admin.students.edit', $student) }}"
                                   class="adm-btn adm-btn-secondary adm-btn-sm">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.students.destroy', $student) }}"
                                      style="display:inline;"
                                      onsubmit="return confirm('Delete {{ addslashes($student->name) }}? This cannot be undone.')">
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
                            <td colspan="9" style="text-align:center;padding:2.5rem;color:#94a3b8;">
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
</x-admin-layout>
