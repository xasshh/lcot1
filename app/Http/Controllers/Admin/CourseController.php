<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::withCount('students')->orderBy('title')->paginate(20);
        return view('admin.courses.index', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'code'       => 'required|string|max:50|unique:courses,code',
            'instructor' => 'nullable|string|max:255',
            'unit'       => 'required|integer|min:1|max:6',
        ]);

        Course::create($data);

        return redirect()->route('admin.courses.index')
            ->with('success', "Course \"{$data['title']}\" created.");
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'code'       => 'required|string|max:50|unique:courses,code,' . $course->id,
            'instructor' => 'nullable|string|max:255',
            'unit'       => 'required|integer|min:1|max:6',
        ]);

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
