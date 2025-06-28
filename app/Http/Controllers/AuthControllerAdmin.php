<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthControllerAdmin extends Controller
{

    public function adm_reg(Request $request)
    {
        $fields = $request->validate([
            'Admin_Name'=>'required|max:255',
            'Admin_Email'=>'required|max:255|unique:admins,Admin_Email',
            'Admin_Password'=>'required|max:255|confirmed',
            'Admin_Phone'=>'required|max:255',
        ]);

        $post = admin::create([
            'Admin_Name'=>$fields['Admin_Name'],
            'Admin_Email'=>$fields['Admin_Email'],
            'Admin_Password'=>Hash::make($fields['Admin_Password']),
            'Admin_Phone'=>$fields['Admin_Phone']
        ]);

        return [
            'User_Details'=>$post,
            'Message'=>'Data Inserted into the DataBase..!!!',
            'Status'=>200
        ];
    }

    public function adm_login(Request $request)
    {
        // return 'Admin_Login_Page';
        $request->validate([
            'Admin_Email'=>'required|max:255',
            'Admin_Password'=>'required|max:255'
        ]);

        $user_search = admin::where('Admin_Email', $request->Admin_Email)->first();

        if(!$user_search || !Hash::check($request->Admin_Password, $user_search->Admin_Password))
        {
            return[
                'User_deatils'=>$user_search,
                'Message'=>'Invalid Credentials Entered..!!!',
                'Status'=>404
            ];
        }

        $token = $user_search->createToken($user_search->Admin_Name);
        return[
            'User_Details'=>$user_search,
            'Token'=>$token->plainTextToken,
            'Message'=>'Login Successful..!!!',
            'Status'=>200
        ];
    }

    public function adm_logout(Request $request)
    {
        // return 'Admin_Logout';
        $request->user()->tokens()->delete();
        return[
            'Message'=>'LoggedOut Successfully..!!!',
            'Status'=>200,
        ];

    }
}
