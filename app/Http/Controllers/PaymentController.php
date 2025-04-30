<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paystack;

class PaymentController extends Controller
{
    public function redirectToGateway(Request $request)
    {
        $request->validate([
            'program' => 'required|string',
        ]);

        session(['program' => $request->program]);

        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        $program = session('program');

        // Optional: Save to DB

        // Auto-download after success
        return response()->download(public_path("forms/{$program}.pdf"));
    }
}

