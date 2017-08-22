<?php

namespace App\Listeners;

use App\Events\MessageCreatedTeacherByStaff;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tzsk\Sms\Facade\Sms;

class StaffSendTextSmsToTeacher implements ShouldQueue
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
     * @param  MessageCreatedTeacherByStaff  $event
     * @return void
     */
    public function handle(MessageCreatedTeacherByStaff $event)
    {
        foreach ($event->teachers as $teacher)
         {       
            $data = [
         
             'student_id'    => null,
             'teacher_id'    => $teacher->id,
             'by_owner_id'   => null,
             'by_teacher_id' => $event->user->id,
             'message'       => $event->message

            ];

              $numbers[] = $teacher->mob_no; 
          
              $event->user->owner->messages()->create($data);
         }

         $sms = Sms::send($event->message, function($sms) use($numbers) {
            $sms->to($numbers); # The numbers to send to.
          });
    }
}
