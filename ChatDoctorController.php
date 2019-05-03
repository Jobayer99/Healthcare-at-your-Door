<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class ChatDoctorController extends Controller
{ 
    public function activate_chat_ajax(Request $request){
        $patient_user_id = $request->patient_user_id;
        $doctor_user_id = Session::get('user_id');
        $row = DB::table('tbl_appointment')
                ->where('doctor_user_id', $doctor_user_id)
                ->where('patient_user_id', $patient_user_id)
                ->update(['done' => 1]);

        $chat = DB::table('tbl_conversation')
                    ->where(function ($query) use($patient_user_id, $doctor_user_id) {
                        $query->where('from_user_id', $patient_user_id)
                            ->orWhere('from_user_id', $doctor_user_id);
                    })
                    ->where(function ($query) use($patient_user_id, $doctor_user_id) {
                        $query->where('to_user_id', $patient_user_id)
                            ->orWhere('to_user_id', $doctor_user_id);
                    })
                ->orderBy('updated_at', 'asc')
                ->get();
        echo json_encode($chat);
                   
    }

    public function send_msg_ajax(Request $request)
    {
        $d['from_user_id'] = Session::get('user_id');
        $d['to_user_id'] = $request->to_user_id;
        $d['message'] = $request->msg;
        DB::table('tbl_conversation')
                ->insert($d);
        echo 200;
    }

    public function load_msg_ajax(Request $request)
    {
        $patient_user_id = $request->to_user_id;
        $result = ['end_chat' => 0, 'msg' => null];
        $doctor_user_id = Session::get('user_id');
        $ap = DB::table('tbl_appointment')
                ->where('tbl_appointment.doctor_user_id', $doctor_user_id)
                ->where('tbl_appointment.patient_user_id', $patient_user_id)
                ->first();
        if($ap){
            $result['end_chat'] = $ap->done;
        }

        if($result['end_chat'] == 1){
            $result['msg'] = DB::table('tbl_conversation')
                                    ->where(function ($query) use($patient_user_id, $doctor_user_id) {
                                        $query->where('from_user_id', $patient_user_id)
                                            ->orWhere('from_user_id', $doctor_user_id);
                                    })
                                    ->where(function ($query) use($patient_user_id, $doctor_user_id) {
                                        $query->where('to_user_id', $patient_user_id)
                                            ->orWhere('to_user_id', $doctor_user_id);
                                    })
                                    ->orderBy('updated_at', 'asc')
                                    ->get();
        }

        echo json_encode($result);
        
    }

    public function feedback_send_ajax(Request $request)
    {
        $d['review_text'] = $request->feedback_text;
        $d['doctor_user_id'] = $request->doctor_user_id;
        $d['patient_user_id'] = Session::get('user_id');
        $d['created_at'] = date('Y-m-d H:i:s');

        DB::table('tbl_review')->insert($d);
        echo 200;
    }

    public function close_chat_ajax(Request $request)
    {
        $d['patient_user_id'] = $request->patient_user_id;
        $d['doctor_user_id'] = Session::get('user_id');
        DB::table('tbl_appointment')
                ->where($d)
                ->update(['done' => 2]);
        echo 'success';
    }


}
