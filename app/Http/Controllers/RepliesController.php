<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Models\Reply;
use Laracasts\Flash\Flash;
use Cache;
use boxue\Listeners\CreatorListener;



class RepliesController extends Controller implements CreatorListener
{

    protected $_response = [];

    /* 权限控制 */
    function __construct()
    {
        $this->middleware('auth:api')
            ->except(['delete', 'store']);

    }

    public function store(StoreReplyRequest $request)
    {
        Cache::forget(spaCacheKey($request->ip(), $request->topic_id));

        app('boxue\Creators\RepliesCreator')->create($this, $request->except('api_token'));

        return response()->json($this->_response);
    }

    public function delete($id, StoreReplyRequest $request)
    {
        $reply = Reply::query()->findOrFail($id);
        $topic = $reply->topic;
        Cache::forget(spaCacheKey($request->ip(), $topic->id));
        $reply->delete();
        $topic->decrement('reply_count');

        if ($topic->reply_count == 0) {
            $topic->last_reply_user_id = 0;
            $topic->save();
        }

        return response()->json(['status' => 'success', 'message' => '删除成功'],200);

    }


    public function creatorSucceed($reply)
    {
        return $this->_response = ['status' => 'success', 'reply' => $reply];
    }

    public function creatorFailed($error)
    {
        return $this->_response = ['status' => 'error', 'message' => $error];
    }


}
