<?php

namespace App\Http\Controllers;

use App\Events\TopicsViewCount;
use App\Http\Requests\StoreTopicRequest;
use App\Models\Category;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Cache;
use Laracasts\Flash\Flash;

class TopicsController extends Controller
{

    const modelCacheExpires = 10;

    /* 权限控制 */
    function __construct()
    {
        $this->middleware('auth', [
            'only' => ['create', 'store'],
        ]);

    }

    /* 显示添加话题表单 */
    public function create()
    {
        $categories = Category::all();
        return view('topics.create', compact('categories'));
    }

    /* 存储话题 */
    public function store(StoreTopicRequest $request)
    {
        if ($this->isDuplicate($request->input())) {
            Flash::error('请不要发送重复内容');
            return redirect()->intended(route('topic.create'));
        }

        $content_slug = slug(Carbon::now()->timestamp, Auth::user()->id);

        Topic::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content_raw' => $request->mark,
            'content_html' => $request->content_html,
            'category_id' => $request->category_id,
            'slug' => $content_slug,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->increment('topic_count');

        Flash::success('发布话题成功!');
        return redirect(route('home'));
    }

    // 编辑话题
    public function edit($id)
    {
        $topic = Topic::query()->findOrFail($id);
        $categories = Category::all();

        return view('topics.edit', compact('topic', 'categories'));
    }

    // 保存编辑
    public function update($id, StoreTopicRequest $request)
    {
        $topic = Topic::query()->findOrFail($id);
        $topic->update([
            'title' => $request->title,
            'content_raw' => $request->mark,
            'content_html' => $request->content_html,
            'category_id' => $request->category_id,
            'updated_at' => Carbon::now()
        ]);


        Cache::forget(cacheKey($topic->user_id, $topic->created_at));
        Flash::success('保存成功!');
        return redirect(route('home'));
    }

    /* 话题详情 */
    /* 使用redis 进行 浏览量计数*/
    public function detail(Request $request)
    {
        $topic = Cache::remember('topic:cache:' . $request->id . ':' . $request->slug, self::modelCacheExpires, function () use($request) {
           return Topic::where([
               ['slug', env("APP_URL") . 'topics/' . $request->id . '/' . $request->slug]
           ])->first();
        });

        $ip = $request->ip();

        event(new TopicsViewCount($topic, $ip, $request->slug, $request->id));


        $user = User::findOrFail($request->id);

        $topics = Topic::where('user_id', $request->id)
                               ->orderBy('updated_at', 'desc')
                               ->limit(5)
                               ->get();

        $replies = Reply::where('topic_id', $topic->id)
                         ->get();

        return view('topics.detail', compact('topic', 'user', 'topics', 'replies'));

    }


    // 上传图片
    public function attachment(Request $request)
    {
        $file = $request->file('image');
        // 图片认证
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );

        // 构造validate进行认证
        $validator = \Validator::make($input, $rules);
        if ($validator->fails()) {
            return \Response::json([
               'error' => '请选择图片'
            ]);
        }

        // 存储图片的目录
        $destinationPath = 'uploads/images/';
        // 获取图片名
        $filename = Auth::user()->id . '_' . Carbon::now() . $file->getClientOriginalName();

        // 移动图片
        $file->move($destinationPath, $filename);

        return \Response::json([
           'filename' => '/' . $destinationPath . $filename
        ]);
    }

    // 点赞
    public function vote($id)
    {
        $topic = Topic::findOrFail($id);

        if ($topic->votes()->where('user_id', Auth::id())->count()) {
            $topic->votes()->where('user_id', Auth::id())->delete();
            $topic->decrement('vote_count');
        } else {
            $topic->votes()->create([
               'user_id' => Auth::id()
            ]);
            $topic->increment('vote_count');
        }

        return response([
            'status'  => 200,
            'message' => $topic->vote_count,
        ]);
    }

    public function delete($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->is_hidden = 0;
        $topic->save();
        Cache::forget(cacheKey($topic->user_id, $topic->created_at));
        Flash::success('隐藏成功!');
        return redirect()->route('home');
    }

    public function retry($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->is_hidden = 1;
        $topic->save();
        Cache::forget(cacheKey($topic->user_id, $topic->created_at));
        Flash::success('恢复成功!');
        return redirect()->route('home');
    }

    /* 查重 */
    protected function isDuplicate($data)
    {
        $last_topic = Topic::where('user_id', Auth::user()->id)
                            ->orderBy('created_at', 'desc')
                            ->first();

        return count($last_topic) && strcmp($last_topic->title, $data['title']) === 0;
    }

}
