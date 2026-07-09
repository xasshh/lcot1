<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::withCount('students');

        if ($request->filled('program')) {
            $query->where('program', $request->program);
        }
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        $courses = $query->orderBy('program')->orderBy('level')->orderBy('title')
            ->paginate(20)->withQueryString();

        return view('admin.courses.index', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'code'       => 'nullable|string|max:50',
            'instructor' => 'nullable|string|max:255',
            'unit'       => 'required|numeric|min:0.5|max:6',
            'program'    => ['nullable', Rule::in(array_keys(Course::PROGRAMS))],
            'level'      => 'nullable|string|max:10',
            'semester'   => ['nullable', Rule::in(Course::SEMESTER_ORDER)],
        ]);

        $data['code'] = $data['code'] ?? '';

        Course::create($data);

        return redirect()->route('admin.courses.index')
            ->with('success', "Course \"{$data['title']}\" created.");
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'code'       => 'nullable|string|max:50',
            'instructor' => 'nullable|string|max:255',
            'unit'       => 'required|numeric|min:0.5|max:6',
            'program'    => ['nullable', Rule::in(array_keys(Course::PROGRAMS))],
            'level'      => 'nullable|string|max:10',
            'semester'   => ['nullable', Rule::in(Course::SEMESTER_ORDER)],
        ]);

        $data['code'] = $data['code'] ?? '';

        $course->update($data);

        return redirect()->route('admin.courses.index')
            ->with('success', "Course updated.");
    }

    public function destroy(Course $course)
    {
        $course->students()->detach();
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', "Course deleted.");
    }
}
