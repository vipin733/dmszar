<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_confirmations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userinvoice_id')->unsigned()->index();
            $table->string('bank_app');
            $table->date('payment_date');
            $table->float('payment_amount');
            $table->string('transaction_no');
            $table->text('remarks');
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
        Schema::dropIfExists('bill_confirmations');
    }
}
