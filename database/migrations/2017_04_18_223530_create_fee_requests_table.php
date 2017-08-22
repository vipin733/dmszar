<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ticket_no');
            $table->integer('student_id')->unsigned()->index();
            $table->integer('fee_request_category_id')->unsigned()->index();
            $table->integer('asession_id')->unsigned()->index();
            $table->integer('action_taken_by_id')->nullable()->unsigned()->index();
            $table->integer('status');
            $table->text('description');
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
        Schema::dropIfExists('fee_requests');
    }
}
