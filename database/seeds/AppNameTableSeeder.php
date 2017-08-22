<?php

use Illuminate\Database\Seeder;

class AppNameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('app_names')->insert([
            ['name' => 'BHIM','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'PayTM','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'FreeCharge','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()]        	
        	]);
    }
}
