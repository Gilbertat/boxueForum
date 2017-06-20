<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Models\Reply;
use App\Models\Topic;
use Carbon\Carbon;

class RepliesController extends Controller
{

    /* 权限控制 */
    function __construct()
    {
        $this->middleware('auth', [
            'only' => ['store'],
        ]);

    }

    public function store(StoreReplyRequest $request)
    {
        if ($this->isDuplicate($request->input())) {
            session()->flash('warning', '请不要发送重复内容!');
        }


        Reply::create([
            'content_raw' => $request->mark,
            'content_html' => $request->content_html,
            'topic_id' => $request->topic_id,
            'user_id' => \Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $topic = Topic::findOrFail($request->topic_id);
        $topic->increment('reply_count');
        $topic->last_reply_user_id = \Auth::user()->id;
        $topic->save();

        return redirect()->back();

    }


    public function isDuplicate($data)
    {
        $last_reply = Reply::where('user_id', \Auth::id())
                            ->where('topic_id', $data['topic_id'])
                            ->orderBy('id', 'desc')
                            ->first();

        return count($last_reply) && strcmp($last_reply->content_raw, $data['mark']) === 0;
    }

}
