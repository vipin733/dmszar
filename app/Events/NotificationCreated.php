<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;



     public $numbers;
     public $school;
     public $title;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($numbers,$school,$title)
    {
        $this->numbers       = $numbers;
        $this->school        = $school;
        $this->title         = $title;

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
