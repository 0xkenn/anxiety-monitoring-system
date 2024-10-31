<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentsTable extends Migration
{
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId(column: 'employee_id')->nullable(); 
            $table->foreignId('student_id')->nullable(); 
            $table->integer('score');
            $table->string('status');
            $table->date('assessment_date');
            $table->timestamps();

            // Foreign key constraint using student_id
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('assessments');
    }
}
