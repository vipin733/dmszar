<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->index();
            $table->uuid('uuid');

            //login table
            $table->string('reg_no')->unique();
            $table->string('password');
            $table->boolean('active');

             //profile table
            $table->string('name');
            $table->integer('course_id')->unsigned()->index();
            $table->integer('created_course_id')->unsigned()->index();
            $table->integer('created_asession_id')->unsigned()->index();
            $table->date('date_of_admission');
            $table->string('last_school')->nullable();
            $table->boolean('hostel');
            $table->integer('hostel_type_id')->nullable()->unsigned()->index();
            $table->boolean('transportation');
            $table->integer('stopage_id')->nullable()->unsigned()->index();


            // personal table
            $table->text('father_name');
            $table->text('mother_name');
            $table->date('date_of_birth');
            $table->integer('gender');
            $table->string('religion');
            $table->string('castec')->nullable();
            $table->string('caste')->nullable();
            $table->string('occupation')->nullable();
            $table->string('emer_no');
            $table->string('parent_no');
            $table->string('parent_email')->nullable();

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
        Schema::dropIfExists('students');
    }
}
