<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthControllerTeacher;
use App\Http\Controllers\AuthControllerAdmin;
use App\Http\Controllers\Stu_AttController;
use App\Http\Controllers\Stu_Marks_T1Controller;
use App\Http\Controllers\Stu_Marks_T2Controller;
use App\Http\Controllers\Stu_Marks_T3Controller;

use App\Http\Controllers\Stu_Marks_Mid1Controller;
use App\Http\Controllers\Stu_Marks_Mid2Controller;
use App\Models\Stu_Marks_T1;

//Section for Students...
Route::get('/register_stu', function(){
    return view('register_stu');
});
Route::post('/register_stu', [AuthController::class, 'register_stu']);
Route::get('/login_stu', function(){
    return view('login_stu');
});
Route::post('/login_stu', [AuthController::class, 'login_stu']);
Route::get('/home_stu', function(){
    return view('home_stu');
});
Route::get('/view_att', function(){
    return view('view_att');
});

Route::get('/stu_update', function(){
    return view('stu_update');
});
Route::get('/stu_details/{id}', [AuthController::class, 'stu_details']);
Route::get('/stu_details_sec/{sec}/{branch}', [AuthController::class, 'stu_details_sec']);

Route::get('/stu_det_sec/{id}', [Stu_AttController::class, 'stu_det_sec']);

Route::get('/exam_marks', function(){
    return view('exam_marks');
});

Route::post('/stu_update/{id}', [AuthController::class, 'stu_update']);
Route::post('/logout_stu', [AuthController::class, 'logout_stu'])->middleware('auth:sanctum');


// Section for Teachers...
Route::get('/register_tea', function(){
    return view('register_tea');
});
Route::post('/register_tea', [AuthControllerTeacher::class, 'register_tea']);
Route::get('/login_tea', function(){
    return view('login_tea');
});
Route::post('/login_tea', [AuthControllerTeacher::class, 'login_tea']);
Route::get('/home_tea', function(){
    return view('home_tea');
});

Route::get('/tea_update', function(){
    return view('tea_update');
});

Route::post('/sub_stu_att/{id}', [Stu_AttController::class, 'sub_stu_att']);

Route::get('/tea_details/{id}', [AuthControllerTeacher::class, 'tea_details']);
Route::post('/tea_update/{id}', [AuthControllerTeacher::class, 'tea_update']);
Route::post('/logout_tea', [AuthControllerTeacher::class, 'logout_tea'])->middleware('auth:sanctum');

Route::get('/stu_details_sec/{sec}', [AuthControllerTeacher::class, 'stu_details_sec']);

Route::get('/stu_att', function(){
    return view('stu_att');
});

//Section for Admin(s)...
Route::post('/adm_reg', [AuthControllerAdmin::class, 'adm_reg']);
Route::get('/adm_login', function(){
    return view('adm_login');
});
Route::post('/adm_login', [AuthControllerAdmin::class, 'adm_login']);
Route::post('/adm_logout', [AuthControllerAdmin::class, 'adm_logout'])->middleware('auth:sanctum');
Route::get('/adm_home', function(){
    return view('adm_home');
});

//Section for Uploading Marks..!!!
Route::get('/stu_marks', function(){
    return view('stu_marks');
});
Route::post('/stu_marks_upl_t1/{id}', [Stu_Marks_T1Controller::class, 'stu_marks_upl_t1']);
Route::get('/t1_marks/{id}', [Stu_Marks_T1Controller::class, 't1_marks']);
Route::post('/stu_marks_upl_t2/{id}', [Stu_Marks_T2Controller::class, 'stu_marks_upl_t2']);
Route::get('/t2_marks/{id}', [Stu_Marks_T2Controller::class, 't2_marks']);
Route::post('/stu_marks_upl_t3/{id}', [Stu_Marks_T3Controller::class, 'stu_marks_upl_t3']);
Route::get('/t3_marks/{id}', [Stu_Marks_T3Controller::class, 't3_marks']);

Route::post('/stu_marks_upl_m1/{id}', [Stu_Marks_Mid1Controller::class, 'stu_marks_upl_m1']);
Route::get('/m1_marks/{id}', [Stu_Marks_Mid1Controller::class, 'm1_marks']);

Route::post('/stu_marks_upl_m2/{id}', [Stu_Marks_Mid2Controller::class, 'stu_marks_upl_m2']);
Route::get('/m2_marks/{id}', [Stu_Marks_Mid2Controller::class, 'm2_marks']);

Route::get('/t1marks/{sec}/{branch}', [Stu_Marks_T1Controller::class, 't1marks_sec_branch']);
Route::get('/t2marks/{sec}/{branch}', [Stu_Marks_T2Controller::class, 't2marks_sec_branch']);
Route::get('/t3marks/{sec}/{branch}', [Stu_Marks_T3Controller::class, 't3marks_sec_branch']);
Route::get('/m1marks/{sec}/{branch}', [Stu_Marks_Mid1Controller::class, 'm1marks_sec_branch']);
Route::get('/m2marks/{sec}/{branch}', [Stu_Marks_Mid2Controller::class, 'm2marks_sec_branch']);




//Anaysis Part
Route::get('/analyse_stu_marks', function(){
    return view('analyse_stu_marks');
});
