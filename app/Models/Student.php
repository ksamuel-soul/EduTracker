<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'Stu_Name',
        'Stu_Branch',
        'Stu_Sec',
        'Stu_Email',
        'Stu_Password',
        'Stu_Phone',
    ];
}
