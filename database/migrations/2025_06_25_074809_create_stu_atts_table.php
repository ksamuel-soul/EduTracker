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
        Schema::create('stu_atts', function (Blueprint $table) {
            $table->string('id');
            $table->string('Stu_Name');
            $table->string('Stu_Branch');
            $table->string('Stu_Sec');
            $table->string("Status");
            $table->timestamps();
            /*'Id',
            'Stu_Name',
            'Stu_Branch',
            'Stu_Sec',
            'Status'*/
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stu_atts');
    }
};
