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
        Schema::create('student', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('first_name'); 
            $table->string('last_name'); 
            $table->unsignedInteger('user_id'); 
            $table->unsignedInteger('class_id'); 
            $table->string('gender', 50); 
            $table->date('date_of_birth'); 
            $table->string('mobile_number', 15); 
            $table->string('profile_pic', 100); 
            $table->tinyInteger('status')->default(0); 
            $table->foreign('class_id')->references('id')->on('class'); 
            $table->foreign('user_id')->references('id')->on('users'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
