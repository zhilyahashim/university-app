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
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->string('department_name');
            $table->string('day');
            $table->string('firstlecture');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('activity');
            $table->string('secondlecture');
            $table->time('starts_time');
            $table->time('ends_time');
            $table->string('activitys');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};
