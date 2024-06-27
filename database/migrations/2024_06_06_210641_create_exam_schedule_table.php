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
        Schema::create('exam_schedule', function (Blueprint $table) {
            $table->increments('id'); 
            $table->unsignedInteger('exam_id'); 
            $table->unsignedInteger('class_id'); 
            $table->unsignedInteger('subject_id'); 
            $table->date('exam_date'); 
            $table->string('start_time'); 
            $table->string('end_time'); 
            $table->string('room_number'); 
            $table->string('full_marks'); 
            $table->string('passing_marks'); 
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
        Schema::dropIfExists('exam_schedule');
    }
};
