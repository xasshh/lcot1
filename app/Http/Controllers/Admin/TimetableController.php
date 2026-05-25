<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        $data = $request->validate([
            'course_timetable' => 'nullable|string',
            'exam_timetable'   => 'nullable|string',
        ]);

        $student->update($data);

        return redirect()->route('admin.timetable.index')
            ->with('success', "Timetable for \"{$student->name}\" updated.");
    }
}
