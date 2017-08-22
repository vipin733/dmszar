<?php

namespace App\Listeners;

use App\Events\MessageCreatedStudentSingle;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tzsk\Sms\Facade\Sms;

class SendTextSmsToStudentSingle implements ShouldQueue
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
     * @param  MessageCreatedStudentSingle  $event
     * @return void
     */
    public function handle(MessageCreatedStudentSingle $event)
    {
         $sms = Sms::send($event->message, function($sms) use($event){
            $sms->to($event->numbers); # The numbers to send to.
          });
    }
}
