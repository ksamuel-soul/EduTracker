<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Stu_Marks_Mid2 extends Model
{
    /** @use HasFactory<\Database\Factories\StuMarksMid2Factory> */
    use HasFactory, HasApiTokens, Notifiable;

   protected $fillable = [
        'id',
        'Stu_Name',
        'Stu_Branch',
        'Stu_Sec',
        'Maths',
        'Physics',
        'Chemistry',
    ];
}
