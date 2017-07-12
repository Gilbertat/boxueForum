<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Models\Reply;
use App\Models\Topic;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Cache;
use League\CommonMark\CommonMarkConverter;
use boxue\Markdown\Markdown;


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
            Flash::error('请不要发送重复内容!');
            return redirect()->back();
        }

        $mark = new Markdown;

        $content_html = $mark->convertMarkdownToHtml($request->editor);

        Reply::create([
            'content_raw' => $request->editor,
            'content_html' => $content_html,
            'topic_id' => $request->topic_id,
            'user_id' => \Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $topic = Topic::findOrFail($request->topic_id);
        Cache::forget(cacheKey($topic->user_id, $topic->created_at));
        $topic->increment('reply_count');
        $topic->last_reply_user_id = \Auth::user()->id;
        $topic->save();

        return redirect()->back();

    }

    public function delete($id)
    {
        $reply = Reply::query()->findOrFail($id);
        $topic = $reply->topic;
        Cache::forget(cacheKey($topic->user_id, $topic->created_at));
        $reply->delete();
        $topic->decrement('reply_count');

        if ($topic->reply_count == 0) {
            $topic->last_reply_user_id = 0;
            $topic->save();
        }

        Flash::success('删除评论成功');
        return redirect()->back();

    }


    public function isDuplicate($data)
    {
        $last_reply = Reply::where('user_id', \Auth::id())
                            ->where('topic_id', $data['topic_id'])
                            ->orderBy('id', 'desc')
                            ->first();

        return count($last_reply) && strcmp($last_reply->content_raw, $data['editor']) === 0;
    }

}
