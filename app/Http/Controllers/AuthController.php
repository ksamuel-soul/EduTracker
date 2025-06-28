<?php

namespace App\Http\Controllers;
use App\Models\student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register_stu(Request $request)
    {
        $fields = $request->validate([
            'Stu_Name'=>'required|max:255',
            'Stu_Branch'=>'required|max:255',
            'Stu_Sec'=>'required|max:255',
            'Stu_Email'=>'required|max:255|unique:students,Stu_Email',
            'Stu_Password'=>'required|max:255|confirmed',
            'Stu_Phone'=>'required|max:255|unique:students,Stu_Phone'
        ]);

        $post = student::create([
            'Stu_Name'=> $fields['Stu_Name'],
            'Stu_Branch'=> $fields['Stu_Branch'],
            'Stu_Sec'=> $fields['Stu_Sec'],
            'Stu_Email'=> $fields['Stu_Email'],
            'Stu_Password'=>Hash::make($fields['Stu_Password']),
            'Stu_Phone'=> $fields['Stu_Phone']
        ]);

        return [
            'post'=>$post,
            'Message'=>'Student Registered Successfully..!!!',
            'Status'=>200
        ];
    }

    public function login_stu(Request $request)
    {
        $request->validate([
            'Stu_Email'=>'required|max:255',
            'Stu_Password'=>'required|max:255',
        ]);
        $user_search = student::where('Stu_Email', $request->Stu_Email)->first();
        if(!$user_search)
        {
            return [
                'Message'=>'Invalid Credentials Entered..!!!',
                'Status'=>404
            ];
        }
        else if(!$user_search || !Hash::check($request->Stu_Password, $user_search->Stu_Password))
        {
            return [
                'Message'=>'The Following Credentials are not Available with Us',
            ];
        }

        $token = $user_search->createToken($user_search->Stu_Name);
        return [
            'post'=>$user_search,
            'Token'=>$token->plainTextToken,
            'Message'=>"Login Successully..!!!",
            'Status'=>200
        ];
    }

    public function stu_details(Request $request, $id)
    {
        $user_search = student::where('id', $id)->first();
        if(!$user_search)
        {
            return[
                
                'Message'=>'No Such User Found with Id: '.$id,
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

    public function stu_details_sec($sec, $branch)
    {
        if($sec == "" || $branch == "")
        {
            return [
                'Message'=>'Details Cannot be Empty',
                'Status'=>204
            ];
        }
        $user_search = student::where('Stu_Sec', $sec)->where('Stu_Branch', $branch)->get();
        if($user_search == "[]")
        {
            return[
                
                'Message'=>'No Students Found in Section: '.$sec.' and Branch: '.$branch,
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

    public function stu_update(Request $request, $id)
    {
       $user_search = student::where('id', $id)->first();
       
       if(!$user_search)
       {
            return [
                'Message'=>'User_Not_Found',
                'Status'=>404
            ];
        }
        else
        {
            $fields = $request->validate([
            'Stu_Name'=>'required|max:255',
            'Stu_Branch'=>'required|max:255',
            'Stu_Sec'=>'required|max:255',
            'Stu_Email'=>'required|max:255|unique:students,Stu_Email',
            'Stu_Phone'=>'required|max:255|unique:students,Stu_Phone'
            ]);

            $user_search->update($fields);
            return [
                'Message'=>'Student Details Updated..!!!',
                'Status'=>200
            ];
        }
    }

    public function logout_stu(Request $request)
    {
        // return 'Logout_API';
        $request->user()->tokens()->delete();
        return[
            'Message'=>'LoggedOut Successfull..!!!',
            'Status'=>200
        ];
    }
}
