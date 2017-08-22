<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StudentTransportFeeReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $total;
     public $number;
     public $regno;
     public $school;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($total, $number, $regno, $school)
    {
        $this->total     = $total;
        $this->number    = $number;
        $this->regno     = $regno;
        $this->school    = $school;
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
