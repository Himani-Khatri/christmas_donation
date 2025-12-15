<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\donationUsers;
use App\Models\donationList;

class donationUserController extends Controller
{
    public function donationUser_index()
    {
        $donationUsers = donationUsers::all();
        return view('donationUser.index', compact('donationUsers'));
    }

    public function donationUser_signup()
    {
        return view('donationUser.signup');
    }


public function markReceived($id)
{
    $donation = donationList::findOrFail($id);
    if($donation->type === 'money'){
        $donation->payment_status = 'completed';
        $donation->save();
    }
    return back()->with('success', 'Money marked as received 💰');
}


    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'email' => 'required|email|unique:donation_users,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'min:6',
        ]);

        $user = new donationUsers();
        $user->fname = $request->fname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->date = $request->date;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('donationUser.login')->with('success', 'Account created successfully!');
    }

    public function donationUser_login(Request $request)
    {
        if ($request->isMethod('post')) {
            $user = donationUsers::where('email', $request->email)->first();

            if ($user && password_verify($request->password, $user->password)) {
                session([
                    'user_id' => $user->id,
                    'email' => $user->email,
                ]);

                return redirect()->route('dashboard');
            }

            return back()->with('error', 'Invalid email or password!');
        }

        return view('donationUser.login');
    }

    public function dashboard()
{
    if (!session('user_id')) {
        return redirect()->route('donationUser.login')->with('error', 'Please login first!');
    }

    $donations = donationList::where('user_id', session('user_id'))->get();
    $allMoneyDonations = donationList::where('type', 'money')->get();

    return view('donationUser.dashboard', [
        'donations' => $donations,
        'allMoneyDonations' => $allMoneyDonations,
        'khaltiKey' => env('KHALTI_PUBLIC_KEY') // pass public key to Blade
    ]);
}




    public function create_donationLists()
{
    if (!session('user_id')) {
        return redirect()->route('donationUser.login')->with('error', 'Please login first!');
    }

    // Fetch donations for the logged-in user
    $donations = donationList::where('user_id', session('user_id'))->get();

    return view('donationUser.donation', compact('donations'));
}




public function store_donationLists(Request $request) {
        $request->validate([
            'full_name'   => 'required',
            'type'        => 'required',
            'amount'      => $request->type === 'money' ? 'required|numeric|min:10' : 'nullable',
            'campaign_id' => 'nullable|exists:campaigns,id',
        ]);

        $donation = new donationList();
        $donation->user_id = session('user_id');
        $donation->full_name = $request->full_name;
        $donation->type = $request->type;
        $donation->amount = $request->type === 'money' ? $request->amount : null;
        $donation->quantity = $request->type !== 'money' ? $request->quantity : null;
        $donation->payment_status = $request->type === 'money' ? 'pending' : 'not_required';
        $donation->campaign_id = $request->campaign_id; // store campaign_id
        $donation->status = $request->type !== 'money' ? 'pending' : null;
        $donation->save();

        return redirect()->route('campaign.donations', ['id' => $request->campaign_id])
                         ->with('success', 'Donation submitted successfully!');
    }





    public function landing()
    {
        return view('donationUser.landing');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('landing');
    }

    public function campaigns()
    {
        return view('donationUser.campaigns');
    }

   

public function showCampaign($id)
{
    $campaign = Campaign::findOrFail($id);
    return view('donationUser.campaign_details', compact('campaign'));
}

public function campaignDonations($id)
{
    $campaign = Campaign::with('donations')->findOrFail($id);
    return view('donationUser.campaign_donation', compact('campaign'));
}

public function showCampaignDonations($id)
{
    // Fetch the campaign with all its donations
    $campaign = \App\Models\Campaign::with('donations')->findOrFail($id);

    // Return the Blade with the campaign data
    return view('donationUser.campaign_donation', compact('campaign'));
}

    

     
}
