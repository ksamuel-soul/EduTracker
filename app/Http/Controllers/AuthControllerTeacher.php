<?php
namespace App\Http\Controllers;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthControllerTeacher extends Controller
{
    public function register_tea(Request $request)
    {
        $fields = $request->validate([
            'Tea_Name'=>'required|max:255',
            'Branch'=>'required|max:255',
            'Tea_Email'=>'required|max:255|unique:teachers,Tea_Email',
            'Password'=>'required|max:255|confirmed',
            'Tea_Phone'=>'required|max:255|unique:teachers,Tea_Phone'
        ]);

        $post = teacher::create([
            'Tea_Name'=>$fields['Tea_Name'],
            'Branch'=>$fields['Branch'],
            'Tea_Email'=>$fields['Tea_Email'],
            'Password'=>Hash::make($fields['Password']),
            'Tea_Phone'=>$fields['Tea_Phone']
        ]);
        return [
            'post'=>$post,
            'Message'=>'Teacher Regsitered Successfully..!!!',
            'Status'=>200
        ];
    }

    public function login_tea(Request $request)
    {
        $request->validate([
            'Tea_Email'=>'required|max:255',
            'Password'=>'required|max:255'
        ]);

        $user_search = teacher::where('Tea_Email', $request->Tea_Email)->first();
        if(!$user_search)
        {
            return [
                'Message'=>'Invalid Credentials Entered..!!!',
                'Status'=>404
            ];
        }
        else if(!$user_search || !Hash::check($request->Password, $user_search->Password))
        {
            return [
                'Message'=>'Invalid Credentials'
            ];
        }

        $token = $user_search->createToken($user_search->Tea_Name);
        return [
            'details'=>$user_search,
            'Message'=>'Login Successfull..!!!',
            "Status"=>200,
            'Token'=>$token->plainTextToken
        ];
    }

    public function tea_details(Request $request, $id)
    {
        $user_search = teacher::where('id', $id)->first();
        if(!$user_search)
        {
            return[
                
                'Message'=>'No Such Teacher Found with Id: '.$id,
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

    public function tea_update(Request $request, $id)
    {
       $user_search = teacher::where('id', $id)->first();
       
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
            'Tea_Name'=>'required|max:255',
            'Branch'=>'required|max:255',
            'Tea_Email'=>'required|max:255|unique:students,Stu_Email',
            'Tea_Phone'=>'required|max:255|unique:students,Stu_Phone'
            ]);

            $user_search->update($fields);
            return [
                'Message'=>'Teacher Details Updated..!!!',
                'Status'=>200
            ];
        }
    }

    public function logout_tea(Request $request)
    {
        $request->user()->tokens()->delete();
        return [
            'Message'=>'LoggedOut Successfully..!!!',
            'Status'=>200
        ];
    }

     public function upd_tea_pass(Request $request, $id)
    {
        $search_user = teacher::where('id', $id)->first();
        if ($search_user) {
            $fields = $request->validate([
                'Password' => 'required|max:255|confirmed',
            ]);
            $search_user->Password = Hash::make($fields['Password']);
            $search_user->save();
            return [
                'Details' => $search_user,
                'Message' => 'Updated Password',
                'Status' => 200
            ];
        } else {
            return [
                'Message' => 'No such User Found..!!!',
                'Status' => 404
            ];
        }
    }
}
