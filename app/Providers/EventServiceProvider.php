<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\StudentAbsent' => [
            'App\Listeners\SendSmsToParents',
        ],

        'App\Events\StudentRegister' => [
            'App\Listeners\SendRrgNoAndPassToParents',
        ],

        'App\Events\StudentTutionFeeReceived' => [
            'App\Listeners\SendTutionFeeConfirmationSmsToParents',
        ],

        'App\Events\StudentTransportFeeReceived' => [
            'App\Listeners\SendTransportFeeConfirmationSmsToParents',
        ],

        'App\Events\StudentHostelFeeReceived' => [
            'App\Listeners\SendHostelFeeConfirmationSmsToParents',
        ],

        'App\Events\StudentRegistraionFeeReceived' => [
            'App\Listeners\SendRegistraionFeeConfirmationSmsToParents',
        ],

        'App\Events\MessageCreatedStudent' => [
            'App\Listeners\SendTextSmsToStudent',
        ],


        'App\Events\MessageCreatedTeacher' => [
             'App\Listeners\SendTextSmsToTeacher',
        ],

        'App\Events\MessageCreatedStudentByStaff' => [
            'App\Listeners\StaffSendTextSmsToStudent',
        ],


        'App\Events\MessageCreatedTeacherByStaff' => [
             'App\Listeners\StaffSendTextSmsToTeacher',
        ],

        'App\Events\MessageCreatedStudentSingle' => [
             'App\Listeners\SendTextSmsToStudentSingle',
        ],

        'App\Events\NotificationCreated' => [
            'App\Listeners\SendNotificationTextSms',
        ],

          'App\Events\TeacherStaff\TeacherStaffRegister' => [
            'App\Listeners\TeacherStaff\SendRrgNoAndPassToTeacherStaff',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
