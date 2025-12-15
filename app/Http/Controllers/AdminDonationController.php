<?php

namespace App\Http\Controllers;

use App\Models\donationList;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\Notification;

class AdminDonationController extends Controller
{
    public function index(){
        $mainDonations = donationList::whereNull('campaign_id')->latest()->get();

        $campaigns = Campaign::with(['donations' => function($q) {
            $q->latest(); 
        }])->get();

        return view('admin.donation', compact('mainDonations','campaigns'));
    }

    public function setPickup(Request $request, $id){
        $donation = donationList::findOrFail($id);

        $donation->pickup_type = $request->pickup_type;
        $donation->pickup_date = $request->pickup_date;
        $donation->status = 'scheduled';
        $donation->save();

        Notification::create([
            'user_id' => $donation->user_id,
            'title' => 'Pickup Scheduled',
            'message' => 'Your donated items will be picked up on ' . $request->pickup_date,
        ]);

        return back()->with('success', 'Pickup scheduled and notification sent!');
    }

    public function updateStatus(Request $request, $id){
        $donation = donationList::findOrFail($id);
        $donation->status = $request->status;
        $donation->save();

        return back()->with('success', 'Status updated ✅');
    }

    public function campaignDonations(){
        $campaigns = Campaign::with('donations')->get();
        return view('admin.campaign_donation', compact('campaigns'));
    }

}