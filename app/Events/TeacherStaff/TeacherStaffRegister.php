<?php

namespace App\Events\TeacherStaff;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TeacherStaffRegister
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $number;
     public $regno;
     public $password;
     public $school;
     public $typename;
     public $father_name;
     public $mother_name;
     public $name;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($number,$regno,$password,$school,$typename, $father_name,$mother_name,$name)
    {
        $this->number      = $number;
        $this->regno       = $regno;
        $this->password    = $password;
        $this->school      = $school;
        $this->typename    = $typename;
        $this->father_name = $father_name;
        $this->mother_name = $mother_name;
        $this->name        = $name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
