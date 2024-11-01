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
        Schema::create('questions', function (Blueprint $table) {
              $table->id(); 
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete()->nullable(); 
            $table->foreignId('student_id')->constrained()->cascadeOnDelete()->nullable();
             $table->string('q0');
             $table->string('q1');
             $table->string('q2');
             $table->string('q3');
             $table->string('q4');
             $table->string('q5');
             $table->string('q6');
             $table->string('q7');
             $table->string('q8');
             $table->string('q9');
             $table->string('q10');
             $table->string('q11');
             $table->string('q12');
             $table->string('q13');
             $table->string('q14');
             $table->string('q15');
             $table->string('q16');
             $table->string('q17');
             $table->string('q18');
             $table->string('q19');
             $table->string('q20');
             $table->string('score')->nullable();
             $table->string('status')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
