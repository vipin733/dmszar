<?php

use Illuminate\Database\Seeder;
use App\Model\SuperAdmin\SuperAdmin;
use Carbon\Carbon;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$characters = 'DZAR';
        $year = Carbon::now()->year;
        $regno = $characters.$year. mt_rand(10000, 99999);

        $data = [
        'name'           => 'Vipin Kumar',
       // 'name'           => 'Sachin Deo Verma',
        'reg_no'         => $regno,
        //'password'       => bcrypt('sachin1994'),
        'password'       => bcrypt('vipin93'),
        'status'         => 1,
        //'email'          => 'sachindeoverma89@gmail.com',
        'email'          => 'vipinoo7@yahoo.in',
        'remember_token' => str_random(10)
        ];

        SuperAdmin::create($data);
    }
}
