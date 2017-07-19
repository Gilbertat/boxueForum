<?php

namespace boxue\Creators;
use boxue\Listeners\CreatorListener;
use Carbon\Carbon;
use App\Models\Topic;
use App\Models\Reply;
use Auth;
use boxue\Markdown\Markdown;
use Cache;


class RepliesCreator {

    public function create(CreatorListener $observer, $data)
    {

        if ($this->isDuplicate($data)) {
            return $observer->creatorFailed('请不要发送重复内容');
        }

        $data['content_raw'] = $data['editor'];
        $mark = new Markdown;
        $data['content_html'] = $mark->convertMarkdownToHtml($data['content_raw']);
        $data['user_id'] = Auth::id();
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        $topic = Topic::query()->findOrFail($data['topic_id']);
        Cache::forget(cacheKey($topic->user_id, $topic->created_at));
        $topic->increment('reply_count');
        $topic->last_reply_user_id = Auth::id();
        $topic-> save();

        $reply = Reply::query()->create($data);

        if (! $reply) {
            return $observer->creatorFailed('发表回复失败');
        }

        return $observer->creatorSucceed($reply);
//
//        $content_html = $mark->convertMarkdownToHtml($request->editor);
//
//        Reply::create([
//            'content_raw' => $request->editor,
//            'content_html' => $content_html,
//            'topic_id' => $request->topic_id,
//            'user_id' => \Auth::user()->id,
//            'created_at' => Carbon::now(),
//            'updated_at' => Carbon::now(),
//        ]);
//
//        $topic = Topic::findOrFail($request->topic_id);
//        Cache::forget(cacheKey($topic->user_id, $topic->created_at));
//        $topic->increment('reply_count');
//        $topic->last_reply_user_id = \Auth::user()->id;
//        $topic->save();
//
//        return redirect()->back();

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