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
        Schema::create('class_timetable', function (Blueprint $table) {
            $table->increments('id'); 
            $table->unsignedInteger('class_id'); 
            $table->unsignedInteger('subject_id'); 
            $table->unsignedInteger('teacher_id'); 
            $table->string('day'); 
            $table->string('start_time'); 
            $table->string('end_time'); 
            $table->string('room_number'); 
            $table->foreign('class_id')->references('id')->on('class'); 
            $table->foreign('subject_id')->references('id')->on('subject'); 
            $table->foreign('teacher_id')->references('id')->on('teacher'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_timetable');
    }
};
