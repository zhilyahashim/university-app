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
        Schema::create('departments', function (Blueprint $table) {
        
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('department_name');
            $table->string('numberofstage')->nullable();
            $table->string('head_name');
            $table->integer('headOfDepartment_id')->unsigned();
            $table->timestamps();
            $table->foreign('headOfDepartment_id')->references('id')->on('users');
            

        });

    }

 
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
