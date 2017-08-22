<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageCreatedTeacherByStaff
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $message;
     public $user;
     public $teachers;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
     public function __construct($message,$user,$teachers)
    {
        $this->message        = $message;
        $this->user           = $user;
        $this->teachers       = $teachers;

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
