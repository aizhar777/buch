<?php

namespace App\Events;

use App\Library\Traits\CurrentUserModel;
use App\Trade;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TradeIncreaseOfItems
{
    use InteractsWithSockets, SerializesModels, CurrentUserModel;

    /**
     * Trade model
     *
     * @var Trade $trade
     */
    public $trade;

    /**
     * User Model
     *
     * @var User $user
     */
    protected $user;

    /**
     * Create a new event instance.
     *
     * @param Trade $trade
     * @param User|null $user
     */
    public function __construct(Trade $trade, User $user = null)
    {
        $this->trade = $trade;
        $this->user = $user;
    }

    /**
     * Trade Creator
     *
     * @return User
     */
    public function getCreator()
    {
        if($this->user instanceof User)
            return $this->user;
        return $this->getCurrentUser();

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel([]);
    }
}
