<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseRegistrationController extends Controller
{
    /**
     * Course registration form for the student's program + current level.
     *
     * Registration is one-shot: once courses are submitted for a level the
     * selection is locked and this page redirects back to the dashboard,
     * where the courses show as a read-only list. The form becomes
     * available again when an admin moves the student to a new level.
     */
    public function create(Request $request)
    {
        $user = $request->user();
        $program = $user->programKey();

        // Legacy accounts (pre program-track signup) pick their track here first.
        if (! $program) {
            return view('course-registration', [
                'user'           => $user,
                'program'        => null,
                'level'          => null,
                'coursesByGroup' => collect(),
            ]);
        }

        $level = $user->currentLevel();

        if ($user->hasRegisteredCoursesForLevel($level)) {
            return redirect()->route('dashboard')
                ->with('info', "Your course registration for " . Course::levelLabel($level) . " has already been submitted and is locked. Contact the college office if it needs to be corrected.");
        }

        return view('course-registration', [
            'user'           => $user,
            'program'        => $program,
            'level'          => $level,
            'coursesByGroup' => Course::forProgramLevel($program, $level),
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $program = $user->programKey();

        if (! $program) {
            $request->validate([
                'program' => ['required', Rule::in(array_keys(Course::PROGRAMS))],
            ]);

            $program = $request->program;
            $user->update([
                'program'       => $program,
                'program_taken' => Course::PROGRAMS[$program],
            ]);

            return redirect()->route('courses.register')
                ->with('success', 'Program saved. Now select your courses below.');
        }

        $level = $user->currentLevel();

        // Locked: one submission per level, students cannot re-submit or edit.
        if ($user->hasRegisteredCoursesForLevel($level)) {
            return redirect()->route('dashboard')
                ->with('info', "Your course registration for " . Course::levelLabel($level) . " is locked and cannot be changed.");
        }

        $data = $request->validate([
            'level'        => ['required', Rule::in([$level])],
            'course_ids'   => ['required', 'array', 'min:1'],
            'course_ids.*' => [
                'integer',
                Rule::exists('courses', 'id')
                    ->where('program', $program)
                    ->where('level', $level),
            ],
        ], [
            'course_ids.required' => 'Please tick at least one course to register.',
            'level.in'            => 'You can only register courses for your current level.',
        ]);

        $user->courses()->attach(
            collect($data['course_ids'])->unique()->mapWithKeys(
                fn ($id) => [$id => ['level' => $level]]
            )->all()
        );

        if (! $user->level) {
            $user->update(['level' => $level]);
        }

        return redirect()->route('dashboard')
            ->with('success', "Course registration for " . Course::levelLabel($level) . " submitted successfully. Your selection is now locked.");
    }
}
