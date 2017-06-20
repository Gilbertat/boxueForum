<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show($id)
    {
        $categories = Category::all();
        $topics = Category::find($id)->topic()->orderBy('updated_at','desc')->paginate(30);
        // 根据id查找指定分类
        $category = Category::findOrFail($id);
        $post = Post::orderBy('updated_at', 'desc')->first();


        return view('topics.index', compact('categories', 'topics', 'category', 'post'));
    }

}
