<?php

namespace App\Listeners;

use App\Events\MessageCreatedStudent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tzsk\Sms\Facade\Sms;

class SendTextSmsToStudent implements ShouldQueue
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
    public function handle(MessageCreatedStudent $event)
    {
        foreach ($event->students as $student)
         {       
            $data = [
         
             'student_id'    => $student->id ,
             'teacher_id'    => null,
             'by_owner_id'   => $event->user->id,
             'by_teacher_id' => null,
             'message'       => $event->message

            ];

                $numbers[] = $student->emer_no; 
          
                $event->user->messages()->create($data);
         }

           $sms = Sms::send($event->message, function($sms) use($numbers){
            $sms->to($numbers); # The numbers to send to.
          });

        //return $sms;
    }
}
