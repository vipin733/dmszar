<?php

namespace App\Listeners;

use App\Events\StudentTutionFeeReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tzsk\Sms\Facade\Sms;
use Illuminate\Http\Request;

class SendTutionFeeConfirmationSmsToParents implements ShouldQueue
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
     * @param  StudentTutionFeeReceived  $event
     * @return void
     */
    public function handle(StudentTutionFeeReceived $event)
    {
        $sms = Sms::send("We have received total Rs. " . $event->total . " with  Reg. No. " . $event->regno . " visit goo.gl/KGjdJs and take print of fee receipt, Regards  " . $event->school, function($sms) use($event) {
            $sms->to([$event->number]); # The numbers to send to.
          });
    }
}
