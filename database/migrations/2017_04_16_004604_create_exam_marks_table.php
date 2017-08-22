<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_marks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('asession_id')->unsigned()->index();
            $table->integer('taker_id')->unsigned()->index();
            $table->integer('exam_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();
            $table->integer('section_id')->unsigned()->index();
            $table->integer('student_id')->unsigned()->index();
            $table->integer('subject_id')->unsigned()->index();
            $table->float('max_mark');
            $table->float('score_mark');
            $table->date('date');
            $table->unique(['asession_id','exam_id','student_id','subject_id'],'as_ex_st_su_id');
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
        Schema::dropIfExists('exam_marks');
    }
}
