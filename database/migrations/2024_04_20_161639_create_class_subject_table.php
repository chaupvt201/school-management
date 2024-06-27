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
        Schema::create('class_subject', function (Blueprint $table) {
            $table->increments('id'); 
            $table->unsignedInteger('class_id')->nullable(); 
            $table->unsignedInteger('subject_id')->nullable(); 
            $table->tinyInteger('status')->default(0); 
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
        Schema::dropIfExists('class_subject');
    }
};
