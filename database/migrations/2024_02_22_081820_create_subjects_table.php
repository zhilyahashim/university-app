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
        Schema::dropIfExists('subjects');
        Schema::create('subjects', function (Blueprint $table) {
           
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('stage');
            $table->string('subject_name');
            $table->string('lecturer_id')->nullable();
            $table->string('lecturer_name');
            $table->string('semester');
            $table->boolean('practice');
            $table->integer('department_id')->unsigned()->nullable();
            $table->integer('staff_id')->unsigned()->nullable();

            $table->timestamps();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('staff_id')->references('id')->on('users')->index();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};

