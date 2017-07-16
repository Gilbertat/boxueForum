<?php

namespace boxue\Creators;
use boxue\Listeners\CreatorListener;
use Carbon\Carbon;
use App\Models\Topic;
use App\Models\User;
use Auth;
use boxue\Markdown\Markdown;

class TopicCreator
{
    public function create(CreatorListener $observer, $data)
    {
        if ($this->isDuplicate($data)) {
            return $observer->creatorFailed('请不要发布重复内容!');
        }

        $data['title'] = $data['title'];
        $data['content_raw'] = $data['editor'];
        $markdown = new Markdown;
        $data['content_html'] = $markdown->convertMarkdownToHtml($data['content_raw']);
        $data['category_id'] = $data['category_id'];
        $data['slug'] = slug(Carbon::now()->timestamp, Auth::id());
        $data['user_id'] = Auth::id();
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        $topic = Topic::query()->create($data);

        if (!$topic) {
            return $observer->creatorFailed($topic->getErrors());
        }

        $user = User::query()->findOrFail(Auth::id());
        $user->increment('topic_count');


        return $observer->creatorSucceed($topic);
//        $content_slug = slug(Carbon::now()->timestamp, Auth::user()->id);
//
//        $mark = new Markdown;
//
//        $content_html = $mark->convertMarkdownToHtml($request->editor);
//
//        Topic::create([
//            'user_id' => Auth::user()->id,
//            'title' => $request->title,
//            'content_raw' => $request->editor,
//            'content_html' => $content_html,
//            'category_id' => $request->category_id,
//            'slug' => $content_slug,
//            'created_at' => Carbon::now(),
//            'updated_at' => Carbon::now(),
//        ]);
//
//        $user = User::findOrFail(Auth::user()->id);
//        $user->increment('topic_count');
//
//        Flash::success('发布话题成功!');
//        return redirect(route('home'));
    }


    protected function isDuplicate($data)
    {
        $last_topic = Topic::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->first();

        return count($last_topic) && strcmp($last_topic->title, $data['title']) === 0;
    }
}