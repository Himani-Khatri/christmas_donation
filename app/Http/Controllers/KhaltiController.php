<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\donationList;

class KhaltiController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'amount' => 'required|numeric',
            'donation_id' => 'required|numeric'
        ]);

        $token = $request->token;
        $amount = $request->amount; // in paisa!
        $donation_id = $request->donation_id;

        $secretKey = env('KHALTI_SECRET_KEY');

        $response = Http::withHeaders([
            'Authorization' => 'Key ' . $secretKey,
            'Content-Type' => 'application/json'
        ])->post('https://khalti.com/api/v2/payment/verify/', [
            'token' => $token,
            'amount' => $amount
        ]);

        $body = $response->json();

        if ($response->successful() && isset($body['idx'])) {
            // mark donation as completed
            $donation = donationList::find($donation_id);
            if ($donation) {
                $donation->payment_status = 'completed';
                $donation->save();
            }

            return response()->json(['success' => true, 'data' => $body]);
        }

        return response()->json([
            'success' => false,
            'message' => $body['detail'] ?? 'Verification failed',
            'error' => $body
        ], 400);
    }
}
