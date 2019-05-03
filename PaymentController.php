<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;



class PaymentController extends Controller
{
    public function payment_list(){
        //login check
        $admin_login = Session::get('admin_login');
        if(!$admin_login){
            return redirect('admin/login');
        }
        //login check end
        $d['payments'] = DB::table('tbl_payment')
                            ->join('tbl_doctor', 'tbl_doctor.user_id', '=', 'tbl_payment.doctor_user_id')
                            ->join('tbl_user', 'tbl_user.user_id', '=', 'tbl_payment.patient_user_id')
                            ->get();
        return view('admin.payment_list', $d);
    }

    public function payment_submit(Request $request){
        $d['doctor_user_id'] = $p['doctor_user_id'] = $request->doctor_user_id;
        $d['patient_user_id'] = $p['patient_user_id'] = Session::get('user_id');
        $d['shift_id'] = $request->shift_id;
        $d['appointment_time'] = $request->appointment_time;
        $d['created_at'] = date('Y-m-d H:i:s');

        $token = $request->stripeToken;
        $email = $request->stripeEmail;
        \Stripe\Stripe::setApiKey('sk_test_YKsf5D6ntLRERpjWpm5prIjH00C06L6831');
        $charge = \Stripe\Charge::create(['amount' => 600 * 100, 'currency' => 'usd', 'source' => $token]);
       
        if($charge){
            $p['appointment_id'] = DB::table('tbl_appointment')->insertGetId($d);
            $p['amount'] = 600;
            $p['transaction_time'] = date('Y-m-d H:i:s');
            DB::table('tbl_payment')->insert($p);
            Session::flash('flash', 'Payment received successfully');
            return redirect('profile');
        }
        return redirect()->back();
        

    }












}
