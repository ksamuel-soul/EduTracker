<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('Admin_Name');
            $table->string('Admin_Email');
            $table->string("Admin_Password");
            $table->string("Admin_Phone");
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
