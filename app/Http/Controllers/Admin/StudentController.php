<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'student');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('matric_number', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%");
            });
        }

        if ($request->filled('program_center')) {
            $query->where('program_center', $request->program_center);
        }

        $students = $query->orderBy('name')->paginate(20)->withQueryString();

        $centers = User::where('role', 'student')
            ->whereNotNull('program_center')
            ->distinct()
            ->pluck('program_center');

        return view('admin.students.index', compact('students', 'centers'));
    }

    public function edit(User $student)
    {
        $courses = Course::orderBy('title')->get();
        $assignedIds = $student->courses()->pluck('courses.id')->toArray();
        return view('admin.students.edit', compact('student', 'courses', 'assignedIds'));
    }

    public function update(Request $request, User $student)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $student->id,
            'matric_number'  => 'nullable|string|max:100|unique:users,matric_number,' . $student->id,
            'program_center' => 'nullable|string|max:100',
            'program_taken'  => 'nullable|string|max:100',
            'year_admitted'  => 'nullable|integer',
            'level'          => 'nullable|string|max:50',
            'gpa'            => 'nullable|numeric|min:0|max:5',
            'cgpa'           => 'nullable|numeric|min:0|max:5',
            'tuition_balance'=> 'nullable|numeric|min:0',
            'course_timetable' => 'nullable|string',
            'exam_timetable'   => 'nullable|string',
            'role'           => 'required|in:student,staff,admin',
        ]);

        $student->update($data);

        if ($request->has('course_ids')) {
            // Carry each course's own level onto the pivot so admin edits
            // don't wipe the per-level registration data.
            $courseLevels = Course::whereIn('id', $request->course_ids)->pluck('level', 'id');
            $student->courses()->sync(
                collect($request->course_ids)->mapWithKeys(
                    fn ($id) => [$id => ['level' => $courseLevels[$id] ?? null]]
                )->all()
            );
        } else {
            $student->courses()->detach();
        }

        return redirect()->route('admin.students.index')
            ->with('success', "Student \"{$student->name}\" updated successfully.");
    }

    public function destroy(User $student)
    {
        $name = $student->name;
        $student->courses()->detach();
        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', "Student \"{$name}\" deleted.");
    }
}
