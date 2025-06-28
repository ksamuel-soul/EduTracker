<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('Tea_Name');
            $table->string('Branch');
            $table->string('Tea_Email');
            $table->string('Password');
            $table->string('Tea_Phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.w
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
