<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Http\Request;

class StudentAbsent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $numbers;
     public $d;
     public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($numbers,$d,$user)
    {
        $this->numbers = $numbers;
        $this->d       = $d;
        $this->user    = $user;

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
