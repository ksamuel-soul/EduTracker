<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        'Tea_Name',
        'Branch',
        'Tea_Email',
        'Password',
        'Tea_Phone'
    ];
}
