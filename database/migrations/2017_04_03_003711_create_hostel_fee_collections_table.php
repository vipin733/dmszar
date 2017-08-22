<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostelFeeCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostel_fee_collections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();
            $table->integer('taker_id')->unsigned()->index();
            $table->integer('hostel_id')->unsigned()->index();
            $table->integer('asession_id')->unsigned()->index();
            $table->float('hostel_fee');
            $table->float('late_fee')->nullable();
            $table->float('other_fee')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('reciept_no');
            $table->boolean('active')->default(1);
            $table->boolean('completed')->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->integer('deleted_by_id')->unsigned()->index()->nullable();
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
        Schema::dropIfExists('hostel_fee_collections');
    }
}
