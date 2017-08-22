<?php

namespace App\Listeners;

use App\Events\NotificationCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tzsk\Sms\Facade\Sms;

class SendNotificationTextSms implements ShouldQueue
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
     * @param  NotificationCreated  $event
     * @return void
     */
    public function handle(NotificationCreated $event)
    {
       $sms = Sms::send("Its look like some importent notification created " .'``'.  $event->title .'``'. " visit goo.gl/mcvhJp Regards " . $event->school, function($sms) use($event) {
            $sms->to($event->numbers); # The numbers to send to.
          });
    }
}
