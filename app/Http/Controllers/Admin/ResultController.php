<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Result upload — super_admin only (enforced by the super_admin
 * middleware on the route group).
 *
 * The upload form mirrors the RESULT CHECK LIST document: per student,
 * per session (YEAR) and level, a score (%) for each course, grouped
 * by semester/module.
 */
class ResultController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'student')->withCount('results');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('matric_number', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%");
            });
        }

        $students = $query->orderBy('name')->paginate(20)->withQueryString();

        return view('admin.results.index', compact('students'));
    }

    public function create(Request $request, User $student)
    {
        abort_unless($student->role === 'student', 404);

        $program = $student->programKey();
        $levels = $program ? Course::PROGRAM_LEVELS[$program] : ['100', '200', '300', '400', '500', 'Masters'];

        $level = in_array($request->query('level'), $levels, true)
            ? $request->query('level')
            : ($student->currentLevel() ?? $levels[0]);

        $session = $request->query('session', $this->defaultSession());

        $coursesByGroup = $program
            ? Course::forProgramLevel($program, $level)
            : collect();

        // Existing scores for this session + level, keyed by course title,
        // so re-opening the form edits rather than duplicates.
        $existing = $student->results()
            ->where('session', $session)
            ->where('level', $level)
            ->get()
            ->keyBy('course_title');

        return view('admin.results.create', compact(
            'student', 'program', 'levels', 'level', 'session', 'coursesByGroup', 'existing'
        ));
    }

    public function store(Request $request, User $student)
    {
        abort_unless($student->role === 'student', 404);

        $program = $student->programKey();
        $levels = $program ? Course::PROGRAM_LEVELS[$program] : ['100', '200', '300', '400', '500', 'Masters'];

        $data = $request->validate([
            'session'  => ['required', 'string', 'max:20'],
            'level'    => ['required', Rule::in($levels)],
            'scores'   => ['required', 'array'],
            'scores.*' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        $courses = Course::whereIn('id', array_keys($data['scores']))
            ->when($program, fn ($q) => $q->where('program', $program))
            ->where('level', $data['level'])
            ->get()
            ->keyBy('id');

        $saved = 0;

        foreach ($data['scores'] as $courseId => $score) {
            $course = $courses->get((int) $courseId);
            if (! $course) {
                continue;
            }

            if ($score === null || $score === '') {
                // Blank score clears a previously uploaded one.
                $student->results()
                    ->where('session', $data['session'])
                    ->where('level', $data['level'])
                    ->where('course_title', $course->title)
                    ->delete();
                continue;
            }

            Result::updateOrCreate(
                [
                    'user_id'      => $student->id,
                    'session'      => $data['session'],
                    'level'        => $data['level'],
                    'course_title' => $course->title,
                ],
                [
                    'course_id'   => $course->id,
                    'semester'    => $course->semester,
                    'score'       => $score,
                    'uploaded_by' => $request->user()->id,
                ]
            );
            $saved++;
        }

        return redirect()
            ->route('admin.results.create', ['student' => $student, 'session' => $data['session'], 'level' => $data['level']])
            ->with('success', "{$saved} score(s) saved for {$student->name} — {$data['session']}, " . Course::levelLabel($data['level']) . ".");
    }

    /**
     * Delete a whole result sheet (one student + session + level).
     */
    public function destroy(Request $request, User $student)
    {
        $data = $request->validate([
            'session' => ['required', 'string'],
            'level'   => ['required', 'string'],
        ]);

        $student->results()
            ->where('session', $data['session'])
            ->where('level', $data['level'])
            ->delete();

        return back()->with('success', "Result sheet ({$data['session']}, " . Course::levelLabel($data['level']) . ") deleted for {$student->name}.");
    }

    private function defaultSession(): string
    {
        $year = now()->month >= 9 ? now()->year : now()->year - 1;

        return $year . '/' . ($year + 1);
    }
}
