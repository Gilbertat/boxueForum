<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Topic;

class TopicsViewCount
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // 帖子实体
    public $topic;

    // 用户ip
    public $ip;

    // 帖子时间戳
    public $slug;

    /**
     * Create a new event instance.
     *
     * @param  $topic
     *
     * @param  $ip
     */
    public function __construct(Topic $topic, $ip, $slug)
    {
        $this->topic = $topic;
        $this->ip = $ip;
        $this->slug = $slug;
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
