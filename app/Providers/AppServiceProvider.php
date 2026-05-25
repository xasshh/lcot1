<?php

namespace App\Providers;

use App\Mail\VerifyEmailMail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url): VerifyEmailMail {
            return new VerifyEmailMail($notifiable, $url);
        });
    }
}
