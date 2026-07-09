<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\Timetable;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'student');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('matric_number', 'like', "%{$s}%");
            });
        }

        $students = $query->orderBy('name')->paginate(20)->withQueryString();

        return view('admin.timetable.index', compact('students'));
    }

    public function update(Request $request, User $student)
    {
        $request->validate([
            'course'          => 'nullable|array',
            'course.*'        => 'array',
            'course.*.time'   => 'nullable|string|max:120',
            'course.*.course' => 'nullable|string|max:150',
            'course.*.venue'  => 'nullable|string|max:120',
            'exam'            => 'nullable|array',
            'exam.*'          => 'array',
            'exam.*.time'     => 'nullable|string|max:120',
            'exam.*.course'   => 'nullable|string|max:150',
            'exam.*.venue'    => 'nullable|string|max:120',
        ]);

        $student->update([
            'course_timetable' => Timetable::encode($request->input('course')),
            'exam_timetable'   => Timetable::encode($request->input('exam')),
        ]);

        return redirect()->route('admin.timetable.index')
            ->with('success', "Timetable for \"{$student->name}\" updated.");
    }
}
