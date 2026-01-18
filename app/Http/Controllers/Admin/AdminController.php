<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

  public function admin_dashboard()
    {
        return view("admin.dashboard");
    }


    public function login()
    {
        return view("admin.login");
    }

    public function admin_login_submit(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        $check = $request->all();
        $data = [
            "email" => $check['email'],
            "password" => $check['password'],
        ];
        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin_dashboard')->with("success", "Login Successfully");
        } else {
            return redirect()->back()->with("error", "Invalid Credentials");
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with("success", "Logout Successfully");
    }

    public function admin_forgot_password()
    {
        return view("admin.forgot");
    }

    public function admin_forgot_password_submit(Request $request)
    {
        dd($request->all());
    }
}
