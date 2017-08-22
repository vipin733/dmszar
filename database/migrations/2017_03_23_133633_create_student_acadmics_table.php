<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAcadmicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_acadmics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id')->unsigned()->index();
            $table->integer('section_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();
            $table->integer('asession_id')->unsigned()->index();
            $table->integer('roll_no');
            $table->timestamps();

            $table->unique(['asession_id','student_id','course_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_acadmics');
    }
}
