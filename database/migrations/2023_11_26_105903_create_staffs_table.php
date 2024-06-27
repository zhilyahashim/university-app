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
        Schema::create('staffs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('staff_name');
            $table->string('staff_email')->unique();
            $table->string('staff_password')->nullable();
            $table->string('staff_address');
            $table->string('position');
            $table->integer('department_id')->unsigned();
           
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
