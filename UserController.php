<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class UserController extends Controller
{
    public function index(){
        //user login check
        $logged_in = Session::get('user_login');
        if($logged_in){
            return redirect('profile');
        }
        //user login check end
        return view('client.login');
    }

    public function profile(){
        //user login check
        $logged_in = Session::get('user_login');
        if(!$logged_in){
            return redirect('login');
        }
        //user login check end
        $user_id = Session::get('user_id');
        $user_role = Session::get('user_role');
        if($user_role == 1){
            //doctor
            $a['profile'] = DB::table('tbl_user')->where('user_id', $user_id)->first();
            $a['appointments'] = DB::table('tbl_appointment')
                                ->select('*')
                                ->join('tbl_user', 'tbl_user.user_id', '=', 'tbl_appointment.patient_user_id')
                                ->join('tbl_shift', 'tbl_appointment.shift_id', '=', 'tbl_shift.shift_id')
                                ->where('tbl_appointment.doctor_user_id', $user_id)
                                ->whereBetween('tbl_appointment.done', [0, 1])
                                ->get();
            return view('client.profile_doctor',$a);
        }
        //patient
        $d['profile'] = DB::table('tbl_user')->where('user_id', $user_id)->first();
        $d['appointments'] = DB::table('tbl_appointment')
                            ->select('*')
                            ->join('tbl_doctor', 'tbl_doctor.user_id', '=', 'tbl_appointment.doctor_user_id')
                            ->join('tbl_shift', 'tbl_appointment.shift_id', '=', 'tbl_shift.shift_id')
                            ->join('tbl_department', 'tbl_department.department_id', '=', 'tbl_doctor.department_id')
                            ->where('tbl_appointment.patient_user_id', $user_id)
                            ->whereBetween('tbl_appointment.done', [0, 1])
                            ->get();
// echo "<pre>";
// print_r($d['appointments']);
// die();
        return view('client.profile_patient', $d);
    }

    public function user_login_attempt(Request $request){
        $d['email'] = $email = $request->email;
        $d['password'] = sha1($request->password);
        $d['user_role'] = $request->user_role;
        $user = DB::table('tbl_user')->where($d)->first();
        if($user){
            Session::put([
                'user_login' => true,
                'user_id' => $user->user_id,
                'user_role' => $user->user_role,
            ]);
            return redirect('profile');
        }
        Session::flash('flash', 'Username and password does not match!');
        return redirect()->back();
    }

    public function user_logout_attempt(){
        Session::forget('user_login', 'user_id', 'user_role');
        Session::flash('flash', 'User logged out!');
        return redirect('login');
    }

    public function user_registration(Request $request){
        $d['email'] = $email = $request->email;
        $exist = DB::table('tbl_user')->where('email', $email)->count();
        if($exist > 0){
            Session::flash('flash', 'This Email already used!');
            return redirect()->back();
        }
        $d['fullname'] = $request->first_name . ' ' . $request->last_name;
        $d['password'] = sha1($request->password);
        $d['birth_date'] = date('Y-m-d', strtotime($request->birth_date));
        $d['skype_id'] = $request->skype;
        $d['created_at'] = date('Y-m-d H:i:s');
        $user_id = DB::table('tbl_user')->insertGetId($d);
        if($user_id){
            Session::put([
                'user_login' => true,
                'user_id' => $user_id,
                'user_role' => 0,
            ]);
            return redirect('profile');
        }
        Session::flash('flash', 'Registration fail!');
        return redirect()->back();
    }
}
