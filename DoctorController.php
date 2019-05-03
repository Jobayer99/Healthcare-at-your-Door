<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Image;
use Session;

class DoctorController extends Controller
{
    public function index(){
        $d['doctors'] = DB::table('tbl_doctor')
                        ->leftJoin('tbl_department', 'tbl_department.department_id', '=', 'tbl_doctor.department_id')
                        ->get();
        return view('client.doctor', $d);
    }

    public function single_doctor($doctor_id){
        $d['doctor'] = DB::table('tbl_doctor')
                    ->select('*')
                    ->join('tbl_user', 'tbl_user.user_id', '=', 'tbl_doctor.user_id')
                    ->join('tbl_department', 'tbl_department.department_id', '=', 'tbl_doctor.department_id')
                    ->where('tbl_user.user_id', $doctor_id)
                    ->first();
        $d['shift'] = DB::table('tbl_shift')->get();
        $d['reviews'] = DB::table('tbl_review')
                            ->select('tbl_user.*', 'tbl_review.review_text')
                            ->join('tbl_user', 'tbl_user.user_id', '=', 'tbl_review.patient_user_id')
                            ->where('doctor_user_id', $doctor_id)
                            ->get();
        return view('client.doctor_single', $d);            
    }

    public function department(){
        $d['departments'] = DB::table('tbl_department')->get();
        return view('client.department', $d);
    }

    public function doctors(){
        //login check
        $admin_login = Session::get('admin_login');
        if(!$admin_login){
            return redirect('admin/login');
        }
        //login check end
        $d['doctors'] = DB::table('tbl_doctor')
                        ->select('*')
                        ->join('tbl_user', 'tbl_user.user_id', '=', 'tbl_doctor.user_id')
                        ->leftJoin('tbl_department', 'tbl_department.department_id', '=', 'tbl_doctor.department_id')
                        ->get();
        return view('admin.doctors', $d);
    }

    public function doctor_form(){
        //login check
        $admin_login = Session::get('admin_login');
        if(!$admin_login){
            return redirect('admin/login');
        }
        //login check end
        $d['departments'] = DB::table('tbl_department')->get();
        return view('admin.doctor_form', $d);
    }

    public function doctor_save(Request $request){
        //login check
        $admin_login = Session::get('admin_login');
        if(!$admin_login){
            return redirect('admin/login');
        }
        //login check end
        $a['email'] = $email = $request->email;
        $exist = DB::table('tbl_user')->where('email', $email)->count();
        if($exist > 0){
            Session::flash('flash', 'This Email already used!');
            return redirect()->back();
        }
        $a['skype_id'] = $request->skype_id;
        $a['user_role'] = 1;
        $a['password'] = sha1($request->password);
        $a['created_at'] = date('Y-m-d H:i:s');
        $d['user_id'] = DB::table('tbl_user')->insertGetId($a);
        //save to user table first

        //file upload
        $doctor_photo = $request->file('photo');
        $destinationPath = 'media/images/doctor';
        $filenametostore = '';
        if ($request->hasfile('photo')) {
            //get filename with extension
            $filenamewithextension = $doctor_photo->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $doctor_photo->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . uniqid() . '.' . $extension;

            if ($doctor_photo) {
                if ($doctor_photo->move($destinationPath, $filenametostore)) {
                    
                }
            }
        }
        //end file upload
        $d['doctor_name'] = $request->doctor_name;
        $d['address'] = $request->address;
        $d['photo'] = $filenametostore;
        $d['department_id'] = $request->department_id;
        $d['doctor_description'] = $request->doctor_description;
        $d['created_at'] = date('Y-m-d H:i:s');
        DB::table('tbl_doctor')->insert($d);

        return redirect('admin/doctors');
    }

    public function doctor_delete(Request $request){
        //login check
        $admin_login = Session::get('admin_login');
        if(!$admin_login){
            return redirect('admin/login');
        }
        //login check end
        $user_id = $request->user_id;
        DB::table('tbl_user')->where('user_id', $user_id)->delete();
        DB::table('tbl_doctor')->where('user_id', $user_id)->delete();
        return redirect('admin/doctors');
    }

    public function check_appointment_ajax(Request $request){
        $doctor_user_id = $request->doctor_user_id;
        $shift_id = $request->shift_id;
        $appointment_date = date('Y-m-d', strtotime($request->appointment_date));

        $check = DB::table('tbl_appointment')
                        ->where('doctor_user_id', $doctor_user_id)
                        ->where('shift_id', $shift_id)
                        ->whereDate('appointment_time', $appointment_date)
                        ->count();
        if($check > 0){
            echo null;
        }else{
            echo 200;
        }
    }
}

