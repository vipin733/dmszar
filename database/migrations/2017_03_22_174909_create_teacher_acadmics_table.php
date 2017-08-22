<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherAcadmicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_acadmics', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->integer('teacher_id')->unsigned()->index();
             $table->integer('section_id')->unsigned()->index();
             $table->integer('course_id')->unsigned()->index();
              $table->integer('asession_id')->unsigned()->index();
             $table->unique(['course_id','section_id','asession_id']);
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
        Schema::dropIfExists('teacher_acadmics');
    }
}
