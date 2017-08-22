<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentHomeWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_home_works', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('teacher_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();
            $table->integer('section_id')->unsigned()->index();
            $table->integer('subject_id')->unsigned()->index();
            $table->integer('asession_id')->unsigned()->index();
            $table->timestamp('submit_at');
            $table->text('homework');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_home_works');
    }
}
