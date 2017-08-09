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
        $this->middleware('auth', [
            'only' => ['store'],
        ]);

    }

    public function store(StoreReplyRequest $request)
    {
        app('boxue\Creators\RepliesCreator')->create($this, $request->except('api_token'));

        return response()->json($this->_response);
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


    public function creatorSucceed($reply)
    {
        return $this->_response = $reply;
    }

    public function creatorFailed($error)
    {
        return $this->_response = ['status' => 'error', 'info' => $error];
    }


}
