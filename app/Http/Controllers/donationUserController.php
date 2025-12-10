<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\donationUsers;

class donationUserController extends Controller
{
    public function donationUser_index(){
        $donationUsers = donationUsers::all();
        return view('donationUser.index', compact('donationUsers'));
    }

    public function donationUser_signup(){
        return view('donationUser.signup');
    }

    public function store(Request $request){
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

    public function donationUser_login(Request $request){
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

    public function dashboard(){
        return view('donationUser.dashboard');
    }
    public function create_donationLists(){
        return view('donationUser.donation');
    }
    public function store_donationLists(Request $request){
        $donationList=new donationList();
        $donationList->user_id=$request->user_id;
        $donationList->full_name=$request->full_name;
        $donationList->type=$request->type;
        $donationList->amount=$request->amount;
        $donationList->payment_status=$request->payment_status;

        $donationList->save();
        return redirect()->route('dashboard');
 
    }
    public function landing(){
        return view('donationUser.landing');
    }
    public function logout() {
        session()->flush();
        return redirect()->route('landing');
    }
    public function campaigns(){
        return view('donationUser.campaigns');
    }
}
