<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('updated_by_id')->unsigned()->index()->nullable();
            $table->timestamp('month');
            $table->string('invoice_no');
            $table->string('payment_method')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->boolean('payment_status');
            $table->integer('payment_amount');
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
        Schema::dropIfExists('user_invoices');
    }
}
