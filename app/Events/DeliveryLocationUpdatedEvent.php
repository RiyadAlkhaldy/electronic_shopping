<?php

namespace App\Events;

use App\Models\Delivery;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeliveryLocationUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public  $delivery;
    /**
     * Create a new event instance.
     */
    public function __construct(public $delivery)
    {
        // $this->delivery = $delivery;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new  Channel('deliveries'),
        ];
    }
    public function broadcastWith()
    {
        return [
            // 'lat' => $this->delivery->lat,
            // 'lng' => $this->delivery->lng,
            'delivery' => $this->delivery
        ];
    }

    public function broadcastAs()
    {
        return 'location-update';
    }
}
