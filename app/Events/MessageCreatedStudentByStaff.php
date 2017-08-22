<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageCreatedStudentByStaff 
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
     
     public $students;
     public $message;
     public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
     public function __construct($students,$message,$user)
    {
        $this->students       = $students;
        $this->message        = $message;
        $this->user           = $user;

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
