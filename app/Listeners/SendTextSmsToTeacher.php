<?php

namespace App\Listeners;

use App\Events\MessageCreatedTeacher;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tzsk\Sms\Facade\Sms;

class SendTextSmsToTeacher implements ShouldQueue
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
     * @param  MessageCreated  $event
     * @return void
     */
    public function handle(MessageCreatedTeacher $event)
    {
        foreach ($event->teachers as $teacher)
         {       
            $data = [
         
             'student_id'    => null,
             'teacher_id'    => $teacher->id,
             'by_owner_id'   => $event->user->id,
             'by_teacher_id' => null,
             'message'       => $event->message

            ];

              $numbers[] = $teacher->mob_no; 
          
              $event->user->messages()->create($data);
         }

         $sms = Sms::send($event->message, function($sms) use($numbers) {
            $sms->to($numbers); # The numbers to send to.
          });
    }
}
