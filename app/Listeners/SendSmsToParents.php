<?php

namespace App\Listeners;

use App\Events\StudentAbsent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tzsk\Sms\Facade\Sms;
use Illuminate\Http\Request;

class SendSmsToParents implements ShouldQueue
{

      
     // public $request;

    /**
     * Create the event listener.

     *
     * @return void
     */
    public function __construct()
    {
         //$this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  StudentAbsent  $event
     * @return void
     */
    public function handle(StudentAbsent $event)
    {
        // $sms = Sms::send("Your child is absent on " . $event->d . " Check Regard " .$event->user->owner->schoolprofile->school_name, function($sms) use($event) {
        //     $sms->to($event->numbers); # The numbers to send to.
        //   });

    }
}
