<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Models\Category;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TopicsController extends Controller
{


    /* 权限控制 */
    function __construct()
    {
        $this->middleware('auth', [
           'only' => ['create', 'store'],
        ]);

        $this->middleware('guest', [
           'only' => ['show'],
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
            session()->flash('warning', '请不要发送重复内容!');
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

        session()->flash("success", '发布话题成功!');
        return redirect(route('home'));
    }

    /* 话题详情 */
    public function detail(Request $request)
    {
        $topic = Topic::where([
            ['user_id', $request->id],
            ['slug', 'http://blog.app/topics/' . $request->id . '/' . $request->slug]
        ])->first();



        \DB::table('topics')->increment('view_count');

        $user = User::findOrFail($request->id);

        $topics = Topic::where('user_id', $request->id)
                               ->orderBy('updated_at', 'desc')
                               ->limit(5)
                               ->get();

        $replies = Reply::where('topic_id', $topic->id)
                         ->orderBy('created_at', 'desc')
                         ->get();

        return view('topics.detail', compact('topic', 'user', 'topics', 'replies'));

    }

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

    /* 查重 */
    protected function isDuplicate($data)
    {
        $last_topic = Topic::where('user_id', Auth::user()->id)
                            ->orderBy('created_at', 'desc')
                            ->first();

        return count($last_topic) && strcmp($last_topic->title, $data['title']) === 0;
    }

}
