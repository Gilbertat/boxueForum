<?php

namespace App\Listeners;

use App\Events\TopicsViewCount;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Redis;

class TopicsEventListener
{

    // 同一帖子最大访问次数，超过该次数刷新数据库
    const topicViewLimit = 2;

    // 同一IP 浏览帖子过期时间
    const ipExpireSec = 300;
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
     * @param  TopicsViewCount  $event
     * @return void
     */
    public function handle(TopicsViewCount $event)
    {
        /*查询topic需要*/
        $topic = $event->topic;
        $ip = $event->ip;
        $id = $event->id;
        $slug = $event->slug;

        if ($this->ipViewLimit($id, $slug, $ip)) {
            $this->updateTopicCacheViewCount($id, $slug, $ip, $topic);
        }

    }

    /* 时间计算 */
    public function ipViewLimit($id, $slug, $ip)
    {
        // 设定redis key
        $ipTopicKey = 'topic:ip:limit:'. $id . ':' . $slug;

        // 使用redis的SISMEMBER命令检查set中有没有该键
        $existsInRedisSet = Redis::command('SISMEMBER', [$ipTopicKey, $ip]);

        // 如果没有该ip记录,则写入该ip到redis中
        if (!$existsInRedisSet) {
            Redis::command('SADD', [$ipTopicKey, $ip]);
            // 设置超时时间，3600秒后再次访问则+1浏览量
            Redis::command('EXPIRE', [$ipTopicKey, self::ipExpireSec]);

            return true;
        }

        return false;
    }

    // 更新数据库
    public function updateTopicViewCount( $count, $topic)
    {
        $topic->view_count += $count;

        $topic->update([
           'view_count' => $topic->view_count,
        ]);
    }

    // 不同用户访问更新浏览次数
    public function updateTopicCacheViewCount($id, $slug, $ip, $topic)
    {
        $cacheKey = 'topic:view:' . $id . ':' . $slug;
        if (Redis::command('HEXISTS', [$cacheKey, $ip])) {
            $incre_count = Redis::command('HINCRBY', [$cacheKey, $ip, 1]);
            if ($incre_count >= self::topicViewLimit) {
                $this->updateTopicViewCount($incre_count - 1, $topic);
                Redis::command('HDEL', [$cacheKey, $ip]);
                Redis::command('DEL', ['laravel:topic:cache:' . $id . ':' . $slug]);
            }
        } else {
            Redis::command('HSET', [$cacheKey, $ip, '1']);
        }
    }
}
