<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostelFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostel_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('hostel_id')->unsigned()->index();
            $table->integer('asession_id')->unsigned()->index();
            $table->float('hostel_fee');
            $table->float('late_fee')->nullable();
            $table->float('other_fee')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->unique(['asession_id','hostel_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hostel_fees');
    }
}
