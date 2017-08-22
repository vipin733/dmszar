<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherStaffAttendencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher__staff__attendences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('teacher_id')->unsigned()->index();
            $table->integer('taker_id')->unsigned()->index();
            $table->integer('asession_id')->unsigned()->index();
            $table->date('date');
            $table->timestamp('entry_time')->nullable();
            $table->timestamp('leave_time')->nullable();
            $table->boolean('marked');
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
        Schema::dropIfExists('teacher__staff__attendences');
    }
}
