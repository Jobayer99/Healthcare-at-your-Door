<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class AdminController extends Controller
{
    public function admin_login(){
        //login check
        $admin_login = Session::get('admin_login');
        if($admin_login){
            return redirect('admin/dashboard');
        }
        //login check end
        return view('admin.login');
    }

    public function login_attempt(Request $request){
        $email = $request->email;
        $password = sha1($request->password);
        $user_role = 999;
        $admin = DB::table('tbl_user')
                    ->where('email', $email)
                    ->where('password', $password)
                    ->where('user_role', $user_role)
                    ->first();
        if($admin){
            Session::put([
                'admin_login' => true,
                'admin_email' => $admin->email,
            ]);
            return redirect('admin/dashboard');
        }
        Session::flash('flash', 'username and password does not match!');
        return redirect('admin/login');
        
    }

    public function admin_logout(){
        Session::forget('admin_login', 'admin_email');
        Session::flash('flash', 'You are logged out!');
        return redirect('admin/login');
    }

    public function dashboard(){
        //login check
        $admin_login = Session::get('admin_login');
        if(!$admin_login){
            return redirect('admin/login');
        }
        //login check end
        return view('admin.dashboard');
    }
}
