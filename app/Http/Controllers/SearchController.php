<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchByPosts(Request $request)
    {
        $key = trim($request->get('q'));

        $posts = Post::query()
            ->where('title', 'like', "%{$key}%")
            ->orWhere('body', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->paginate(2);

        $posts->withPath('/search?q=' . $key);

        return view('search.index', [
            'key' => $key,
            'posts' => $posts,
        ]);
    }
}
