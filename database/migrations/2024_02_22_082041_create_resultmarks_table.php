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
        Schema::create('resultmarks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('department_id')->unsigned()->nullable(true);
            $table->integer('staff_id')->unsigned()->nullable();
            $table->string('student_name');
            $table->string('subject_name');
            $table->string('department_name');
            $table->string('midterm_theory');
            $table->string('midterm_practice');
            $table->string('daily');
            $table->string('final_theory');
            $table->string('final_practice');
            
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('staff_id')->references('id')->on('staffs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultmarks');
    }
};
