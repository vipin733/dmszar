<?php

use Illuminate\Database\Seeder;

class LogRequestCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('log_request_categories')->insert([
            ['name' => 'Examination','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'Academic','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'Complain','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()] ,
            ['name' => 'Fee','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],           
            ['name' => 'Teacher/Staff MisBehavior','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()]        	      	
        	]);
    }
}
