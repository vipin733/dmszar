<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;
use App\AppProfile;
use App\SchoolProfile;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
        'name' => 'dmszar',
        'email' => 'demo@dmszar.com',
        'password' => bcrypt('demodmszar'),
        'plan' => 1,
        'mobile_no' => 7690000017,
        'email_token' => base64_encode('demo@dmszar.com'),
        'active' => 1,
        'remember_token' => str_random(10),
        'trial_end_at'  => Carbon::now()->addDays(30),
        ]);

       AppProfile::create([
        'user_id' => 1,
        'app_name' => 'Dmszar public school'
        ]);

        SchoolProfile::create([
        'user_id'  => 1,
        'school_name' => 'Dmszar public school'
        ]);
    }
}
