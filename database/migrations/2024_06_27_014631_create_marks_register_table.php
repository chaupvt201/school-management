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
        Schema::create('marks_register', function (Blueprint $table) {
            $table->increments('id'); 
            $table->unsignedInteger('student_id'); 
            $table->unsignedInteger('exam_id'); 
            $table->unsignedInteger('class_id'); 
            $table->unsignedInteger('subject_id'); 
            $table->integer('class_work')->default(0); 
           // $table->integer('test_work')->default(0); 
           // $table->integer('exam')->default(0); 
           $table->foreign('student_id')->references('id')->on('student'); 
           $table->foreign('exam_id')->references('id')->on('exam'); 
           $table->foreign('class_id')->references('id')->on('class'); 
           $table->foreign('subject_id')->references('id')->on('subject'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks_register');
    }
};
