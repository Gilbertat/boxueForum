<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class StaticPagesController extends Controller
{
    public function home()
    {
        $topics = Topic::orderBy('updated_at', 'desc')->paginate(30);
        $post = Post::orderBy('updated_at', 'desc')->first();
        $categories = Category::all();
        return view('topics.index', compact('topics', 'categories', 'post'));
    }


}
