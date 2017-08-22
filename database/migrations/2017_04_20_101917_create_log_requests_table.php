<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ticket_no');
            $table->integer('asession_id')->unsigned()->index();
            $table->integer('teacher_id')->nullable()->unsigned()->index();
            $table->integer('student_id')->nullable()->unsigned()->index();
            $table->integer('action_taker_id')->nullable()->unsigned()->index();
            $table->integer('log_category_id')->unsigned()->index();
            $table->text('subject');
            $table->text('description')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('log_requests');
    }
}
