<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLunchTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunch_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('asession_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            // $table->integer('day_id')->unsigned()->index();
            $table->dateTime('start');
            $table->dateTime('end');
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
        Schema::dropIfExists('lunch_times');
    }
}
