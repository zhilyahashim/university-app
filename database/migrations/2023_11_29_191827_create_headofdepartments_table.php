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
        Schema::create('headofdepartments', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('head_name');
            $table->string('head_email')->unique(); // Corrected column definition
            $table->string('head_password');
            $table->string('head_phone')->nullable()->unique();
            $table->string('head_stage')->nullable();
            $table->string('head_image')->nullable();
            $table->integer('department_id')->unsigned();
            $table->integer('staff_id')->unsigned();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            
            
            $table->timestamps();
            $table->rememberToken();
            
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('staff_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('headofdepartments');
    }
};
