<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    public function dashboard()
    {
        return view("user.dashboard");
    }



    public function registration()
    {
        return view("user.registration");
    }

    public function registration_submit(Request $request)
    {
        $request->validate([
            'name' => "required|max:255",
            "email" => "required|max:255|email|unique:users,email",
            "password" => "required",
            "confirm_password" => "required|same:password",
        ]);

        $token = hash('sha256', time());
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->token = $token;
        $user->save();

        $links = url('registration_verify/' . $token . '/' . $request->email);
        $message = "Please click the below link to verify your Registration:<br> <a href='" . $links . "'>" . $links . "</a>";
        Mail::to($request->email)->send(new Websitemail("Verify Registration", $message));


        return redirect()->route('registration')->with('success', 'Registration successful! Please check You   email to verify your account.');
    }


    public function registration_verify(Request $request, $token, $email)
    {

        $user = User::where("email", $email)->where("token", $token)->first();
        if (!$user) {
            return redirect()->route('login')->with("error", "Invalid token or email");
        }

        $user->token = '';
        $user->status = 'active';
        $user->update();

        return redirect()->route('login')->with("success", "Email verified successfully. Now you can login.");
    }

    public function login(Request $request)
    {
        return view("user.login");
    }
    public function login_submit(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        $check = $request->all();
        $data = [
            "email" => $check['email'],
            "password" => $check['password'],
            'status' => 'active'
        ];
        if (Auth::guard('web')->attempt($data)) {
            return redirect()->route('user_dashboard')->with("success", "Login Successfully");
        } else {
            return redirect()->back()->with("error", "Invalid Credentials");
        }
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login')->with("success", "Logout Successfully");
    }
    public function forgot_password()
    {
        return view("user.forgot");
    }

    public function forgot_password_submit(Request $request)
    {
        $request->validate([
            "email" => "required|email",
        ]);
        $user = User::where("email", $request->email)->first();
        if (!$user) {
            return redirect()->back()->with("error", "Email not found");
        }
        $token = hash('sha256', time());
        $user->token = $token;
        $user->update();

        $links = route('reset_password_submit', ['token' => $token, 'email' => $request->email]);
        $subject = "Reset Password";
        $message = "Click on the following links to reset your password:<br>";
        $message .= "<a href='" . $links . "'>" . $links . "</a>";
        Mail::to($request->email)->send(new Websitemail($subject, $message));
        return redirect()->back()->with("success", "Reset password link sent to your email");
    }

     public function reset_password($token, $email){
        $user = User::where('email', $email)->where('token', $token)->first();
        if (!$user) {
            return redirect()->back()->with("error", "Invalid token or email");
        }

        return view("admin.reset", compact('token', 'email'));
    }
    
    public function password_submit(Request $request, $token, $email){
        $request->validate([
            "password" => "required",
            'confirm_password' => "required|same:password",
        ]);

        $user = User::where("email", $email)->where("token", $token)->first();
        if (!$user) {
            return redirect()->route('login')->with("error", "Invalid token or email");
        }

        $user->password = Hash::make($request->password);
        $user->token = '';
        $user->update();

        return redirect()->route('login')->with("success", "Password reset successfully");
    }

}
