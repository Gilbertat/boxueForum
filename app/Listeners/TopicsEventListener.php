<?php

namespace App\Listeners;

use App\Events\TopicsViewCount;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TopicsEventListener
{
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
        //
    }
}
