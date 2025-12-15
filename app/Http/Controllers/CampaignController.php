<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
    public function admin_index(){
        $campaigns = Campaign::orderBy('id', 'DESC')->get();
        return view('admin.campaign.index', compact('campaigns'));
    }

    public function admin_create(){
        return view('admin.campaign.create');
    }

    public function admin_store(Request $request){
        $request->validate([
            'title'       => 'required|max:255',
            'description' => 'nullable',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'banner'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $bannerName = null;

        if ($request->hasFile('banner')) {
            $bannerName = time() . '-' . $request->banner->getClientOriginalName();
            $request->banner->move(public_path('uploads/campaigns'), $bannerName);
        }

        Campaign::create([
            'title'       => $request->title,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'banner'      => $bannerName,
            'is_active'   => true,
        ]);

        return redirect()->route('admin.campaign.index')
                         ->with('success', 'Campaign created successfully!');
    }

    public function user_campaigns(){
        $campaigns = Campaign::where('is_active', true)->get();
        return view('donationUser.campaigns', compact('campaigns'));
    }

    public function user_campaign_show($id){
        $campaign = Campaign::findOrFail($id);
        return view('donationUser.campaign_details', compact('campaign'));
    }
}
