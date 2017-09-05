<?php

namespace App\Listeners;

use App\Events\TopicViewCount;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Cache;

class TopicViewCountListener
{

    // 同一帖子最大访问次数，超过该次数刷新数据库
    const topicViewLimit = 1;

    // 同一IP 浏览帖子过期时间
    const ipExpireSec = 5;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TopicViewCount  $event
     * @return void
     */
    public function handle(TopicViewCount $event)
    {
        $topic = $event->topic;
        $id = $event->id;
        $ip = $event->ip;


        if ($this->ipLimit($id, $ip)) {
            $this->updateTopic($topic);
            Cache::forget(spaCacheKey($ip, $id));
        }

    }

    // 检查ip是否存在于缓存中
    public function ipLimit($id, $ip)
    {
        $key = 'topic:' . $ip . ':ids:' . $id;

        if (Cache::has($key)) {
            return false;
        }

        Cache::add($key, $ip, self::ipExpireSec);

        return true;
    }

    // 更新topic
    public function updateTopic($topic)
    {
        $topic->view_count += 1;
        $topic->save();
    }

}
