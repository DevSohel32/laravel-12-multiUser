<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminController extends Controller
{
 public function admin_login(){
    return view("admin.login");
 }

 public function admin_login_submit(Request $request){
    dd($request->all());
 }

 public function admin_forgot_password(){
    return view("admin.forgot");
 }

 public function admin_forgot_password_submit(Request $request){
    dd($request->all());
 }
}
