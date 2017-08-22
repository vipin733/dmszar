<?php

namespace App\Listeners;

use App\Events\MessageCreatedStudentByStaff;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tzsk\Sms\Facade\Sms;

class StaffSendTextSmsToStudent implements ShouldQueue
{


    /**
     * Create a new event instance.
     *
     * @return void
     */
    
     public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  MessageCreatedStudentByStaff  $event
     * @return void
     */
    public function handle(MessageCreatedStudentByStaff $event)
    {
        foreach ($event->students as $student)
         {       
            $data = [
         
             'student_id'    => $student->id,
             'teacher_id'    => null,
             'by_owner_id'   => null,
             'by_teacher_id' => $event->user->id,
             'message'       => $event->message

            ];

                $numbers[] = $student->emer_no; 
          
                $event->user->owner->messages()->create($data);
         }

           $sms = Sms::send($event->message, function($sms) use($numbers){
            $sms->to($numbers); # The numbers to send to.
          });

    }
}
