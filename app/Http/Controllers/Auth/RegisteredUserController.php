<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Mail\NewStudentRegisteredNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
  public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'programCenter' => 'required',
        'programTaken' => ['required', Rule::in(array_keys(Course::PROGRAMS))],
        'yearAdmitted' => 'required',
        'full_matric_number' => ['required', 'string', 'unique:users,matric_number'],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'matric_number' => $request->full_matric_number,
        'program_center' => $request->programCenter,
        'program' => $request->programTaken,
        'program_taken' => Course::PROGRAMS[$request->programTaken],
        'level' => Course::PROGRAM_LEVELS[$request->programTaken][0],
        'year_admitted' => $request->yearAdmitted,
    ]);

    try {
        event(new Registered($user));
        Mail::to(env('ADMIN_NOTIFICATION_EMAIL',  'abujalifecollege@gmail.com'))
            ->send(new NewStudentRegisteredNotification($user));
    } catch (\Exception $e) {
        Log::error('Registration emails failed: ' . $e->getMessage());
    }

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
}

}
