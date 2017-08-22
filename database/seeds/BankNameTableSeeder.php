<?php

use Illuminate\Database\Seeder;

class BankNameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('bank_names')->insert([
            ['name' => 'SBI','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'PNB','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'UBI','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'BOI','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'Kotak Bank','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],        	
        	]);
    }
}
