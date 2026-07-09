<x-admin-layout>
    <x-slot name="title">Results</x-slot>

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.results.index') }}"
          style="display:flex;gap:0.75rem;margin-bottom:1.25rem;flex-wrap:wrap;align-items:flex-end;">
        <div class="adm-search-wrap" style="flex:1;min-width:200px;">
            <span class="adm-search-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input type="text" name="search" value="{{ request('search') }}"
                   class="adm-input adm-search-input" placeholder="Search by name, matric number or email…">
        </div>
        <button type="submit" class="adm-btn adm-btn-primary">Search</button>
        @if(request('search'))
            <a href="{{ route('admin.results.index') }}" class="adm-btn adm-btn-secondary">Clear</a>
        @endif
    </form>

    <div class="adm-card">
        <div class="adm-card-header">
            <div class="adm-card-title">
                Students
                <span class="adm-badge adm-badge-slate" style="margin-left:0.5rem;">{{ $students->total() }}</span>
            </div>
        </div>
        <div style="overflow-x:auto;">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Matric No.</th>
                        <th>Programme</th>
                        <th>Level</th>
                        <th>Scores Uploaded</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td style="font-weight:600;color:#1e293b;">{{ $student->name }}</td>
                            <td><span style="font-family:monospace;font-size:0.8rem;color:#475569;">{{ $student->matric_number ?? '—' }}</span></td>
                            <td style="color:#64748b;">{{ $student->programLabel() ?? '—' }}</td>
                            <td>
                                @if($student->currentLevel())
                                    <span class="adm-badge adm-badge-blue">{{ $student->currentLevel() }}</span>
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                <span class="adm-badge {{ $student->results_count ? 'adm-badge-green' : 'adm-badge-slate' }}">
                                    {{ $student->results_count }}
                                </span>
                            </td>
                            <td style="text-align:right;white-space:nowrap;">
                                <a href="{{ route('admin.results.create', $student) }}" class="adm-btn adm-btn-primary adm-btn-sm">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Upload / Edit Result
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;padding:2.5rem;color:#94a3b8;">
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
