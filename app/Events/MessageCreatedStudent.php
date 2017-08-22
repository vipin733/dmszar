<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageCreatedStudent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
     public $message;
     public $user;
     public $students;

    /**
     * Create a new event instance.
     *
     * @return void
     */
  

     public function __construct($message,$user,$students)
    {
        $this->message        = $message;
        $this->user           = $user;
        $this->students       = $students;

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
//$students,$r,$user