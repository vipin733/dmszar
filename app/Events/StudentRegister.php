<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StudentRegister
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $number;
     public $regno;
     public $password;
     public $school;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($number,$regno,$password,$school)
    {
        $this->number   = $number;
        $this->regno    = $regno;
        $this->password = $password;
        $this->school   = $school;
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
