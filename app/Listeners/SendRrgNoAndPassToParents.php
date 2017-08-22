<?php

namespace App\Listeners;

use App\Events\StudentRegister;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tzsk\Sms\Facade\Sms;

class SendRrgNoAndPassToParents implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StudentRegister  $event
     * @return void
     */
    public function handle(StudentRegister $event)
    {
         $sms = Sms::send("Your child Reg. No. " . $event->regno . " And Password is " . $event->password . " visit goo.gl/8kqust and change Password Regards " .$event->school, function($sms) use($event) {
            $sms->to([$event->number]); # The numbers to send to.
          });
    }
}
