<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCCRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_c_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ticket_no');
            $table->integer('certificate_category_id')->unsigned()->index();
            $table->integer('asession_id')->unsigned()->index();
            $table->integer('student_id')->unsigned()->index();
            $table->integer('updated_by_id')->nullable()->unsigned()->index();
            $table->text('description')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('status');
            $table->boolean('fee_status');
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
        Schema::dropIfExists('c_c_requests');
    }
}
