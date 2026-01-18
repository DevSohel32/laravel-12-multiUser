<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        $request->validate([
            "email" => "required|email",
        ]);
        $admin = Admin::where("email", $request->email)->first();
        if (!$admin) {
            return redirect()->back()->with("error", "Email not found");
        }
        $token = hash('sha256', time());
        $admin->token = $token;
        $admin->update();

        $links = route('admin_reset_password_submit', ['token' => $token, 'email' => $request->email]);
        $subject = "Reset Password";
        $message = "Click on the following links to reset your password:<br>";
        $message .= "<a href='" . $links . "'>" . $links . "</a>";
        Mail::to($request->email)->send(new Websitemail($subject, $message));
        return redirect()->back()->with("success", "Reset password link sent to your email");
    }

    public function reset_password($token, $email){
        $admin = Admin::where('email', $email)->where('token', $token)->first();
        if (!$admin) {
            return redirect()->back()->with("error", "Invalid token or email");
        }

        return view("admin.reset", compact('token', 'email'));
    }

    public function reset_password_submit(Request $request, $token, $email){
        $request->validate([
            "password" => "required",
            'confirm_password' => "required|same:password",
        ]);

        $admin = Admin::where("email", $email)->where("token", $token)->first();
        if (!$admin) {
            return redirect()->route('admin_login')->with("error", "Invalid token or email");
        }

        $admin->password = Hash::make($request->password);
        $admin->token = '';
        $admin->update();

        return redirect()->route('admin_login')->with("success", "Password reset successfully");
    }
}
