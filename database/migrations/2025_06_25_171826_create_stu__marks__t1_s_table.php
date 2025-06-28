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
        Schema::create('stu__marks__t1_s', function (Blueprint $table) {
            $table->string("id");
            $table->string("Stu_Name");
            $table->string("Stu_Branch");
            $table->string("Stu_Sec");
            $table->string("Maths");
            $table->string("Physics");
            $table->string("Chemistry");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stu__marks__t1_s');
    }
};
