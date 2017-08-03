<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TestController extends Controller
{
    public function index()
    {
        return view('test.test');
    }

    public function show()
    {
        $topics = Topic::query()->where('is_hidden',1)
            ->orderBy('updated_at', 'desc')
            ->with('user')
            ->paginate(30);



        return view('test.test', compact('topics'));

    }
}
