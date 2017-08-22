<?php

namespace App\Listeners;

use App\Events\StudentRegistraionFeeReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tzsk\Sms\Facade\Sms;

class SendRegistraionFeeConfirmationSmsToParents implements ShouldQueue
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
     * @param  StudentRegistraionFeeReceived  $event
     * @return void
     */
    public function handle(StudentRegistraionFeeReceived $event)
    {
        $sms = Sms::send("We have received total Rs. " . $event->total . " with  Reg. No. " . $event->regno . " visit goo.gl/wdAp6o and take print of fee receipt, Regards  " . $event->school, function($sms) use($event) {
            $sms->to([$event->number]); # The numbers to send to.
          });
    }
}
