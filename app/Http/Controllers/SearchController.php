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

        //get all the categories
//        $categories = Category::all();

        return view('search.index', [
            'key' => $key,
            'posts' => $posts,
//            'categories' => $categories,
        ]);
    }
}
