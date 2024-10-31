<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();  // program_id
            $table->string('program_name'); 
            $table->string('abbrev')->unique(); 
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');  // Foreign key to schools
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
