<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Dotation;
use App\Models\Arme;
use Illuminate\Support\Collection;


class DotationCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $dotation;
    public $armes;
    /**
     * Create a new event instance.
     */
    public function __construct(Dotation $dotation, Collection $armes)
    {
        $this->dotation = $dotation;
        $this->armes = $armes;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
