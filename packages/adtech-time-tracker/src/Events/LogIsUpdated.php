<?php

namespace Adtech\AdtechTimeTracker\Events;

use Adtech\AdtechTimeTracker\Models\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogIsUpdated implements
    ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $log;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('test-pusher');
    }

    public function broadcastAs()
    {
        return 'log-updated';
    }
}
