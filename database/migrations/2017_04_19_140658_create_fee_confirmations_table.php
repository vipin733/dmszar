<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_confirmations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ticket_no');
            $table->integer('course_id')->unsigned()->index();
            $table->integer('asession_id')->unsigned()->index();
            $table->integer('student_id')->unsigned()->index();
            $table->date('deposit_date');
            $table->integer('bank_name_id')->nullable()->unsigned()->index();
            $table->integer('app_name_id')->nullable()->unsigned()->index();
            $table->string('transaction_no');
            $table->integer('taken_by_id')->nullable()->unsigned()->index();
            $table->float('tution_fee')->nullable();
            $table->float('hostel_fee')->nullable();
            $table->float('transport_fee')->nullable();
            $table->float('registration_fee')->nullable();
            $table->float('late_fee')->nullable();
            $table->float('other_fee')->nullable();
            $table->text('remarks')->nullable();
            $table->text('reply')->nullable();
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
        Schema::dropIfExists('fee_confirmations');
    }
}
