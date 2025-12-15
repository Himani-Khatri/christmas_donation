<?php

namespace App\Http\Controllers;

use App\Models\donationList;
use App\Models\Campaign;
use Illuminate\Http\Request;

class AdminDonationController extends Controller
{
    public function index()
    {
        // Fetch standalone donations (not linked to any campaign)
        $mainDonations = donationList::whereNull('campaign_id')->latest()->get();

        // Fetch all campaigns with their donations
        $campaigns = Campaign::with(['donations' => function($q) {
            $q->latest(); // latest donations first
        }])->get();

        return view('admin.donation', compact('mainDonations','campaigns'));
    }

    public function setPickup(Request $request, $id)
    {
        $donation = donationList::findOrFail($id);

        $donation->pickup_type = $request->pickup_type; // instant | scheduled
        $donation->pickup_date = $request->pickup_date;
        $donation->status = 'approved';
        $donation->save();

        return back()->with('success', 'Pickup scheduled 🚚');
    }

    public function updateStatus(Request $request, $id)
    {
        $donation = donationList::findOrFail($id);
        $donation->status = $request->status;
        $donation->save();

        return back()->with('success', 'Status updated ✅');
    }

    public function campaignDonations()
{
    $campaigns = Campaign::with('donations')->get();
    return view('admin.campaign_donation', compact('campaigns'));
}

}
