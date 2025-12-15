<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(){
        return view('admin.login');
    }

    public function doLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'admin_id' => $admin->id,
                'admin_email' => $admin->email
            ]);

            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid admin credentials ❌');
    }

    public function dashboard(){
        if (!session('admin_id')) {
            return redirect()->route('admin.login');
        }

        return view('admin.dashboard');
    }

    public function logout(){
        session()->forget(['admin_id', 'admin_email']);
        return redirect()->route('admin.login');
    }
}
