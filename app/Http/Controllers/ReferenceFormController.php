<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReferenceFormController extends Controller
{
    // Handles payment initialization
    public function pay(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'program' => 'required|string',
        ]);

        $email = auth()->user()->email ?? 'abujalifecollege@gmail.com';
        $amount = $request->input('amount') * 100; // Convert to Kobo
        $program = $request->input('program');

        $response = Http::withToken(config('paystack.secretKey'))->post('https://api.paystack.co/transaction/initialize', [
            'email' => $email,
            'amount' => $amount,
            'callback_url' => route('reference.callback'),
            'metadata' => [
                'program' => $program,
            ],
        ]);

        $data = $response->json();

        if ($data['status']) {
            return redirect($data['data']['authorization_url']);
        }

        return back()->with('error', $data['message'] ?? 'Payment failed to initialize.');
    }

    // Handles Paystack callback
    public function handleGatewayCallback(Request $request)
    {
        $reference = $request->query('reference');

        $response = Http::withToken(config('paystack.secretKey'))->get("https://api.paystack.co/transaction/verify/{$reference}");

        $data = $response->json();

        if ($data['status'] && $data['data']['status'] === 'success') {
            // Get the program name from metadata
            $program = $data['data']['metadata']['program'];

            // Logic to match and serve the correct form file
            $filename = match($program) {
                'Bachelor of Theology' => 'bachelor_of_theology.pdf',
                'Certificate in Christian Ministry' => 'ccm.pdf',
                'Certificate in Music' => 'cm.pdf',
                'Diploma in Music' => 'dm.pdf',
                'Diploma in Theology' => 'dt.pdf',
                default => null
            };

            if ($filename && file_exists(public_path("forms/{$filename}"))) {
                return response()->download(public_path("forms/{$filename}"));
            }

            return redirect('/')->with('error', 'Form not found after payment.');
        }

        return redirect('/')->with('error', 'Payment not verified.');
    }
}
