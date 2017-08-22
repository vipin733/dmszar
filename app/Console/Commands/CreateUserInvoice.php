<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Auth\UserInvoice;
use Auth;
use App\User;
use Carbon\Carbon;
class CreateUserInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'User:Invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create User Invoice.';

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
         $lastmonth = Carbon::now()->subMonth(1)->month;

        //return $lastmonth;
          $users = User::whereHas('subscriptions',function($q) use($lastmonth){
                            $q->orderBy('created_at','desc')
                              ->whereMonth('created_at',$lastmonth);
                        })->where(function($q){
                           $q->where('plan','!=',0)
                              ->where('active',1);
                        })->orWhere(function($q){
                           $q->where('plan',1)
                              ->where('plan',2);
                        })->select('id')->get();
       //return $users;
       $invoice_no = UserInvoice::orderBy('invoice_no','desc')->select('invoice_no')->first();

       if ($invoice_no) {
           $no = $invoice_no->invoice_no;
       }else{
           $no = 1;
       }

       foreach ($users as $user) {
          $subscription  =  $user->subscriptions->first();

          //return $subscription;

          $data = [

             'user_id'               =>  $user->id,
             'updated_by_id'         =>  null,
             'month'                 =>  $subscription->created_at,
             'invoice_no'            =>  $no ++,
             'payment_method'        =>  null,
             'payment_date'          =>  null,
             'remarks'               =>  null,
             'payment_status'        =>  0,
             'payment_amount'        =>  10 * $subscription->no_student
          ];

          UserInvoice::create($data);
        }
    }
}
