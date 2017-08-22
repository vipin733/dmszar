<?php

use Illuminate\Database\Seeder;

class AppDayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('days')->insert([
            ['name' => 'Sunday','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'Monday','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'Tuesday','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'Wednesday','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'Thursday','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()], 
             ['name' => 'Friday','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'Saturday','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()]       	
         ]);
    }
}
