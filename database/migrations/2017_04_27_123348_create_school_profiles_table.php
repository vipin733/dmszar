<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->index();
            $table->text('school_name');
            $table->string('logo')->nullable();
            $table->integer('school_board_id')->nullable()->unsigned()->index();
            $table->string('affiliation_no')->nullable();
            $table->string('school_code_no')->nullable();
            $table->string('website')->nullable();
            $table->string('school_email')->nullable();
            $table->string('telephone_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->text('school_address')->nullable();
            $table->string('city')->nullable();
            $table->integer('state_id')->nullable()->unsigned()->index();
            $table->integer('district_id')->nullable()->unsigned()->index();
            $table->integer('pincode')->nullable();
            $table->tinyInteger('campuse_type')->nullable();
            $table->boolean('main_campuse')->nullable();
            $table->boolean('hostel_service')->nullable();
            $table->tinyInteger('hostel_type')->nullable();
            $table->boolean('transport_service')->nullable();
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
        Schema::dropIfExists('school_profiles');
    }
}
