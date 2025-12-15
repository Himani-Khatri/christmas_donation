<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\donationList;

class KhaltiController extends Controller
{
    public function initiate(Request $request){
        $request->validate([
            'full_name' => 'required',
            'amount' => 'required|numeric|min:10',
            'campaign_id' => 'nullable|exists:campaigns,id', 
        ]);

        $donation = donationList::create([
            'user_id' => session('user_id'),
            'full_name' => $request->full_name,
            'type' => 'money',
            'amount' => $request->amount,
            'payment_status' => 'pending',
            'campaign_id' => $request->campaign_id, 
        ]);

        $payload = [
            "return_url" => route('khalti.verify'),
            "website_url" => url('/'),
            "amount" => $request->amount * 100,
            "purchase_order_id" => $donation->id,
            "purchase_order_name" => "Donation",
            "customer_info" => [
                "name" => $request->full_name,
                "email" => "test@khalti.com",
                "phone" => "9800000001"
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Key ' . env('KHALTI_SECRET_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://dev.khalti.com/api/v2/epayment/initiate/', $payload);

        if ($response->successful()) {
            return redirect($response->json()['payment_url']);
        }

        return back()->with('error', 'Khalti initiation failed');
    }

    public function verify(Request $request){
        $pidx = $request->pidx;

        $response = Http::withHeaders([
            'Authorization' => 'Key ' . env('KHALTI_SECRET_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://dev.khalti.com/api/v2/epayment/lookup/', [
            'pidx' => $pidx
        ]);

        $data = $response->json();

        if (($data['status'] ?? '') === 'Completed') {

            $donationId = $data['order']['purchase_order_id'] ?? null;

            if ($donationId) {
                $donation = donationList::find($donationId);
                if ($donation) {
                    $donation->payment_status = 'completed';
                    $donation->save();
                }
            }

            return redirect()->route('dashboard')->with('success', 'Payment Successful 🎉');
        }

        return redirect()->route('dashboard')->with('error', 'Payment Failed');
    }
}
