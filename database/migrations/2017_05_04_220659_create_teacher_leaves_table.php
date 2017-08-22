<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_leaves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('leave_type');
            $table->dateTime('leave_start')->nullable();
            $table->dateTime('leave_end')->nullable();
            $table->dateTime('leave_time_start')->nullable();
            $table->dateTime('leave_time_end')->nullable();
            $table->text('reason');
            $table->integer('teacher_id')->unsigned()->index();
            $table->integer('action_taken_by')->nullable()->unsigned()->index();
            $table->integer('status');
            $table->text('remarks')->nullable();
            $table->integer('asession_id')->unsigned()->index();            
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
        Schema::dropIfExists('leaves');
    }
}
