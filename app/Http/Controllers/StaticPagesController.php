<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

class StaticPagesController extends Controller
{
    public function home()
    {
        $topics = Topic::query()->where('is_hidden',1)
                                ->orderBy('created_at', 'desc')
                                ->paginate(30);

        $post = Post::orderBy('updated_at', 'desc')->first();
        $categories = Category::all();
        return view('topics.index', compact('topics', 'categories', 'post'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $users = User::search($query, null, true)->orderBy('id', 'asc')->limit(5)->get();
        $topics = Topic::search($query, null, true)->paginate(30);

        return view('searches.search', compact('users', 'topics', 'query'));
    }
}
