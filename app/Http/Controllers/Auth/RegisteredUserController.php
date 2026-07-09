<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    // The programme track is not chosen at signup — students select it on the
    // course-registration page (dashboard) before picking their courses.
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'programCenter' => 'required',
        'yearAdmitted' => 'required',
        'full_matric_number' => ['required', 'string', 'unique:users,matric_number'],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'matric_number' => $request->full_matric_number,
        'program_center' => $request->programCenter,
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
