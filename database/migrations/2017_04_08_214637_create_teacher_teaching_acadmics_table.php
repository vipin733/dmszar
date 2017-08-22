<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherTeachingAcadmicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_teaching_acadmics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('asession_id')->unsigned()->index();
            $table->integer('teacher_id')->unsigned()->index();
            $table->integer('section_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();
            $table->integer('subject_id')->unsigned()->index();
            $table->unique(['asession_id','teacher_id','section_id','course_id','subject_id'],'sec_te_as_co_su_id');
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
        Schema::dropIfExists('teacher_teaching_acadmics');
    }
}
