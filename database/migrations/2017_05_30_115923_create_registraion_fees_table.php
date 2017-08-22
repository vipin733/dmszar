<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistraionFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registraion_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id')->unsigned()->index();
            $table->integer('asession_id')->unsigned()->index();
            $table->float('registraion_fee');
            $table->float('late_fee')->nullable();
            $table->text('fee_details');
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->unique(['asession_id','course_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registraion_fees');
    }
}
