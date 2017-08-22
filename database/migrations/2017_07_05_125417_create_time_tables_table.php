<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('section_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();
            $table->integer('asession_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();

            $table->integer('sunday_subject_id')->unsigned()->index()->nullable();
            $table->integer('sunday_teacher_id')->unsigned()->index()->nullable();           
            $table->integer('sunday_room_id')->unsigned()->index()->nullable();           
            $table->text('sunday_remarks')->nullable(); 

            $table->integer('monday_subject_id')->unsigned()->index()->nullable();
            $table->integer('monday_teacher_id')->unsigned()->index()->nullable();           
            $table->integer('monday_room_id')->unsigned()->index()->nullable();           
            $table->text('monday_remarks')->nullable(); 

            $table->integer('tuesday_subject_id')->unsigned()->index()->nullable();
            $table->integer('tuesday_teacher_id')->unsigned()->index()->nullable();
            $table->integer('tuesday_room_id')->unsigned()->index()->nullable();
            $table->text('tuesday_remarks')->nullable();

            $table->integer('wednesday_subject_id')->unsigned()->index()->nullable();
            $table->integer('wednesday_teacher_id')->unsigned()->index()->nullable();
            $table->integer('wednesday_room_id')->unsigned()->index()->nullable();
            $table->text('wednesday_remarks')->nullable();

            $table->integer('thursday_subject_id')->unsigned()->index()->nullable();
            $table->integer('thursday_teacher_id')->unsigned()->index()->nullable();
            $table->integer('thursday_room_id')->unsigned()->index()->nullable();
            $table->text('thursday_remarks')->nullable();

            $table->integer('friday_subject_id')->unsigned()->index()->nullable();
            $table->integer('friday_teacher_id')->unsigned()->index()->nullable();
            $table->integer('friday_room_id')->unsigned()->index()->nullable();
            $table->text('friday_remarks')->nullable();

            $table->integer('saturday_subject_id')->unsigned()->index()->nullable();
            $table->integer('saturday_teacher_id')->unsigned()->index()->nullable();
            $table->integer('saturday_room_id')->unsigned()->index()->nullable();
            $table->text('saturday_remarks')->nullable();

            $table->dateTime('start');
            $table->dateTime('end');
           
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
        Schema::dropIfExists('time_tables');
    }
}
