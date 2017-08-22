<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->index();
            $table->uuid('uuid');
            //login table
            $table->string('reg_no')->unique();
            $table->string('password');
            $table->boolean('type');

             //profile table
            $table->string('name');
            $table->boolean('active');
            $table->string('mob_no');
            $table->string('last_school')->nullable();
            $table->string('experience')->nullable();
            $table->boolean('transportation');
            $table->integer('stopage_id')->nullable()->unsigned()->index();

             // personal table 
            $table->text('father_name');
            $table->text('mother_name');
            $table->date('date_of_birth');
            $table->integer('gender');
            $table->string('email')->nullable();
            $table->string('emergency_no')->nullable();
            $table->date('date_of_joining');

             //   addresses table
            $table->string('permanent_address');
            $table->integer('permanent_district_id')->unsigned()->index();
            $table->integer('permanent_state_id')->unsigned()->index();
            $table->integer('permanent_zip_pin');
            $table->string('communication_address');
            $table->integer('communication_district_id')->unsigned()->index();
            $table->integer('communication_state_id')->unsigned()->index();           
            $table->integer('communication_zip_pin');
            $table->string('avatar')->nullable();

            $table->text('bio')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('teachers');
    }
}
