<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        if (! $request->user()->email) {
            return back()->with('error', 'User email address could not be resolved.');
        }

        try {
            $request->user()->sendEmailVerificationNotification();
            return back()->with('status', 'verification-link-sent');
        } catch (\Exception $e) {
            \Log::error('Verification email resend failed: ' . $e->getMessage());
            return back()->withErrors(['mail' => 'The mail server is currently offline. Your registration was saved, but we could not deliver the email. Please check your local laravel.log file.']);
        }
    }
}
