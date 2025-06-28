<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Stu_Marks_Mid2;

use Illuminate\Http\Request;

class Stu_Marks_Mid2Controller extends Controller
{
    public function stu_marks_upl_m2(Request $request, $id){
        $search_stu = student::where('id', $id)->first();
        $duplicate_marks = stu_marks_mid2::where('id', $id)->first();

        if($search_stu)
        {
            if(!$duplicate_marks)
            {
                $fields = $request->validate([
                    'id'=>'required|max:255',
                    'Stu_Name'=>'required|max:255',
                    'Stu_Branch'=>'required|max:255',
                    'Stu_Sec'=>'required|max:255',
                    'Maths'=>'required|max:255',
                    'Physics'=>'required|max:255',
                    'Chemistry'=>'required|max:255'
                ]);

                $post = stu_marks_mid2::create($fields);
                return [
                    'Post'=>$post,
                    'Message'=>'Marks Uploaded for the Student: '.$id,
                    'Status'=>200
                ];
            }
            else
            {
                return [
                    'Message'=>'Duplicates Cannot be Sent..!!!',
                    'Status'=>409
                ];
            }
        }
        else
        {
            return [
                'Message'=>'No Student Found with Id: '.$id,
                'Status'=>404
            ];
        }
    }

    public function m2_marks(Request $request, $id)
    {
        $search_user = stu_marks_mid2::where('id',$id)->first();
        if($search_user)
        {
            return [
                'Message'=>'Found',
                'Status'=>200,
                'Exam_Mode'=>'M2',
                'Details'=>[$search_user]
            ];
        }
        else
        {
            return [
                'Message'=>'Nothing Found..!!!',
                'Status'=>404,
            ];
        }
    }

     public function m2marks_sec_branch(Request $request, $sec, $branch)
    {
        $user_find = stu_marks_mid2::where('Stu_sec', $sec)->where('Stu_Branch', $branch)->get();

        if($user_find)
        {
            return [
                'Message'=>'User_Found',
                'Status'=>200,
                'User_Details'=>$user_find
            ];
        }
        else
        {
            return [
                'Message'=>'No Such User Found..!!!',
                'Status'=>404
            ];
        }
    }
}
