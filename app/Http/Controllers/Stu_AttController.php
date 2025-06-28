<?php

namespace App\Http\Controllers;

use App\Models\stu_att;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Stu_AttController extends Controller
{
    public function sub_stu_att(Request $request, $id)
    {
        $fields = $request->validate([
            "id"=>"required|max:255",
            "Stu_Name"=>"required|max:255",
            "Stu_Branch"=>"required|max:255",
            "Stu_Sec"=>"required|max:255",
            "Status"=>"required|max:255"
        ]);
        $now = Carbon::now();
        $records = stu_att::where('id', $id)->where('created_at', '>=', $now->subHours(12))->first();
        if($records)
        {
            return [
                'Message'=>"Today's Attendance_Marked",
                'Status'=>404
            ];
        }
        else
        {
           $post = stu_att::create($fields);
            return [
                'post'=>$post,
                'Message'=>'Attendance_Marked',
                'Status'=>200
            ];
        }
    }

     public function stu_det_sec($id)
    {
        $user_search = stu_att::where('id', $id)->get();
        if($user_search == "[]")
        {
            return[
                
                'Message'=>'No Student Found with Id: '.$id,
                'Status'=>404
            ];
        }
        else
        {
            return[
                'Message'=>'User_Found',
                'User_Details'=>$user_search,
                'Status'=>200
            ];
        }
    }
}
