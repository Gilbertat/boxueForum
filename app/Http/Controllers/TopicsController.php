<?php

namespace App\Http\Controllers;

use App\Events\TopicsViewCount;
use App\Http\Requests\StoreTopicRequest;
use App\Models\Category;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Cache;
use Laracasts\Flash\Flash;
use Intervention\Image\ImageManagerStatic as Image;
use boxue\Markdown\Markdown;
use boxue\Listeners\CreatorListener;


class TopicsController extends Controller implements CreatorListener
{

    const modelCacheExpires = 10;


    private $_response = [];
    /* 权限控制 */
    function __construct()
    {
        $this->middleware('auth', [
            'only' => ['create', 'store'],
        ]);

    }

    public function index()
    {
        // 话题
        $topics = Topic::query()->where('is_hidden',1)
            ->orderBy('updated_at', 'desc')
            ->with('user', 'category', 'lastReplyUser')
            ->paginate(30);

        // 公告
        $post = Post::orderBy('updated_at', 'desc')->first();

        // 分类
        $categories = Category::all();


        return response()
            ->json([
                'url' => env('APP_URL'),
                'topics' => $topics,
                'post' => $post,
                'categories' => $categories,
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
        app('boxue\Creators\TopicCreator')->create($this, $request->except('_token'));
        return response()->json($this->_response);
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


        Cache::forget(cacheKey($topic->user_id, $topic->created_at));

        $mark = new Markdown;

        $content_html = $mark->convertMarkdownToHtml($request->editor);

        $topic->update([
            'title' => $request->title,
            'content_raw' => $request->editor,
            'content_html' => $content_html,
            'category_id' => $request->category_id,
            'updated_at' => Carbon::now()
        ]);

        $topic->last_reply_user_id = \Auth::user()->id;

        $topic->save();

        Flash::success('保存成功!');
        return redirect(route('home'));
    }

    /* 话题详情 */
    /* 使用redis 进行 浏览量计数*/
    public function detail(Request $request)
    {
        $topic = Cache::remember('topic:cache:' . $request->id . ':' . $request->slug, self::modelCacheExpires, function () use ($request) {
            return Topic::where([
                ['slug', env("APP_URL") . 'topics/' . $request->id . '/' . $request->slug]
            ])->first();
        });

        $ip = $request->ip();

        event(new TopicsViewCount($topic, $ip, $request->slug, $request->id));


        $user = User::findOrFail($request->id);

        if ($user->id == Auth::id()) {
            $topics = Topic::where('user_id', $request->id)
                ->orderBy('updated_at', 'desc')
                ->limit(5)
                ->get();
        } else {
            $topics = Topic::where('user_id', $request->id)
                ->where('is_hidden',1)
                ->orderBy('updated_at', 'desc')
                ->limit(5)
                ->get();
        }

        $replies = Reply::where('topic_id', $topic->id)
            ->paginate(25);

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
        $filename = Auth::user()->id . '_' . $file->getClientOriginalName();
        // 移动图片
        $file->move($destinationPath, $filename);

        $img = Image::make($destinationPath . $filename)
            ->resize(650, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        $img->save();

        return \Response::json([
            'filename' => env('APP_URL') . $destinationPath . $filename
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
            'status' => 200,
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


    /*
     *
     *  creatorListener Delegate
     *
     */
    public function creatorFailed($error)
    {
        $this->_response = ['status' => 'error', 'info' => $error, 'href'=>'/'];
    }

    public function creatorSucceed($topic)
    {
        $this->_response = ['status'=>'success', 'info'=>'发布成功!', 'href'=> $topic->link()];
    }

}
