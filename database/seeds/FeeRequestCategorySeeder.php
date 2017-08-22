<?php

use Illuminate\Database\Seeder;

class FeeRequestCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fee_request_categories')->insert([
            ['name' => 'Fee Extension','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()],
            ['name' => 'Fee Refund','created_at' => \Carbon\Carbon::now(),
            'updated_at' =>\Carbon\Carbon::now()]
          	]);  
    }
}
