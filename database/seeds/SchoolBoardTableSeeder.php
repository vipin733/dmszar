<?php

use Illuminate\Database\Seeder;

class SchoolBoardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('school_boards')->insert([
            ['name' => 'CBSE BOARD','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'ICSE BOARD','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'U.P. BOARD','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()]
            
            ]);
    }
}
