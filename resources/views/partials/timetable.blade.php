{{--
    Renders a student timetable column (users.course_timetable / exam_timetable).

    Params: $raw (string|null), $timeLabel (optional, defaults to "Time").

    New records are a Monday–Saturday JSON grid → desktop table + stacked
    cards on mobile. Legacy records are pipe-separated text → old table.
--}}
@php
    $timeLabel = $timeLabel ?? 'Time';
    $grid = \App\Support\Timetable::decode($raw ?? null);
    $filledDays = $grid ? \App\Support\Timetable::filledDays($grid) : [];
@endphp

@if($grid && count($filledDays))

    @once
        {{-- Self-contained breakpoint CSS: the compiled Tailwind bundle may not
             include sm:block / sm:hidden, so don't depend on it. --}}
        <style>
            .tt-desktop { display: none; }
            .tt-mobile  { display: block; }
            @media (min-width: 640px) {
                .tt-desktop { display: block; overflow-x: auto; }
                .tt-mobile  { display: none; }
            }
        </style>
    @endonce

    {{-- Desktop / tablet: full Monday–Saturday table --}}
    <div class="tt-desktop">
        <table class="db-table">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>{{ $timeLabel }}</th>
                    <th>Course</th>
                    <th>Venue</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grid as $day => $row)
                    <tr>
                        <td class="font-semibold text-slate-700 whitespace-nowrap">{{ $day }}</td>
                        <td class="whitespace-nowrap">{{ $row['time'] !== '' ? $row['time'] : '—' }}</td>
                        <td>{{ $row['course'] !== '' ? $row['course'] : '—' }}</td>
                        <td>{{ $row['venue'] !== '' ? $row['venue'] : '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Mobile: stacked cards, blank days hidden --}}
    <div class="tt-mobile divide-y divide-slate-100">
        @foreach($filledDays as $day => $row)
            <div class="px-4 py-3">
                <p class="text-xs font-bold uppercase tracking-widest text-red-600 mb-1">{{ $day }}</p>
                <p class="text-sm font-semibold text-slate-700">{{ $row['course'] !== '' ? $row['course'] : '—' }}</p>
                <p class="text-xs text-slate-500 mt-0.5">
                    {{ $row['time'] !== '' ? $row['time'] : '—' }}
                    @if($row['venue'] !== '')
                        &middot; {{ $row['venue'] }}
                    @endif
                </p>
            </div>
        @endforeach
    </div>

@elseif(!empty($raw) && ! $grid)

    {{-- Legacy free-text data (pipe-separated lines) --}}
    <div class="overflow-x-auto">
        <table style="width:100%;border-collapse:collapse;">
            @foreach(explode("\n", trim($raw)) as $i => $line)
                <tr>
                    @foreach(array_map('trim', explode('|', $line)) as $cell)
                        @if($i === 0)
                            <th style="background:#1e293b;color:#f1f5f9;padding:9px 14px;text-align:left;font-size:0.68rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;white-space:nowrap;">{{ $cell }}</th>
                        @else
                            <td style="padding:9px 14px;color:#475569;border-bottom:1px solid #f1f5f9;font-size:0.84rem;vertical-align:middle;">{{ $cell }}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>

@else
    <p style="color:#94a3b8;font-size:0.875rem;padding:1.5rem 1rem;">No timetable available.</p>
@endif
