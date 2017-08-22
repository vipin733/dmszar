<?php

namespace App\Listeners\TeacherStaff;

use App\Events\TeacherStaff\TeacherStaffRegister;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tzsk\Sms\Facade\Sms;
use PDF;

class SendRrgNoAndPassToTeacherStaff implements ShouldQueue
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
     * @param  TeacherStaffRegister  $event
     * @return void
     */
    public function handle(TeacherStaffRegister $event)
    {
        $sms = Sms::send("Your Reg. No. " . $event->regno . " And Password is " . $event->password . " visit goo.gl/Z2mUA2 and change Password, Regards " .$event->school, function($sms) use($event) {
            $sms->to([$event->number]); # The numbers to send to.
          });

        // $regno       = $event->regno;
        // $password    = $event->password;
        // $school      = $event->school;
        // $typename    = $event->typename;
        // $father_name = $event->father_name;
        // $mother_name = $event->mother_name;
        // $name        = $event->name;

        //  $pdf=PDF::loadView('partial.download_passowrd_id',compact('regno','password','school','typename','father_name','mother_name','name'));

        //  return $pdf->download('pdf.pdf');
    }
}
