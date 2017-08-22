<?php

namespace App\Console\Commands;

use App\User;
use App\Model\Auth\Subscription;
use Illuminate\Console\Command;

class DailyUserSubscriptionDetailCreation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'User:Subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating User Subscription Detials.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::where('active',1)->where('plan','!=',0)->with('students','teachers')->select('id')->get();
        
       foreach ($users as $user) {
          $students  =  $user->students()->where('active',1)->count();
          $staffs    =  $user->teachers()->where('type',1)->where('active',1)->count();
          $teachers  =  $user->teachers()->where('type',0)->where('active',1)->count();

          $data = [

             'user_id'         =>  $user->id,
             'no_student'      =>  $students,
             'no_teacher'      =>  $teachers,
             'no_staff'        =>  $staffs,
             'no_message_sent' =>  null
          ];

          Subscription::create($data);

          
       }
    }
}
