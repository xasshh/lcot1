<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Timetable;
use App\Models\Payment;


class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Get the currently logged-in user
$courses = auth()->user()->courses;

        return view('dashboard', compact('user','courses'));
    }
}

