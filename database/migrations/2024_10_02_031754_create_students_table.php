<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->foreignId('school_id');
            $table->foreignId('program_id');
            $table->string('user_id')->unique();
            $table->string('password');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->date('birthdate');
            $table->string('sex');
            $table->string('mobile_number');
            $table->string('email')->unique();
            $table->string('province');
            $table->string('municipality');
            $table->string('barangay');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }

}
