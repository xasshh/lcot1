<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_students' => User::where('role', 'student')->count(),
            'total_staff'    => User::whereIn('role', ['staff', 'admin'])->count(),
            'total_courses'  => Course::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
