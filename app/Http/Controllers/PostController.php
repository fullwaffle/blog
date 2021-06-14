<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Services\SortService;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Illuminate\View\View;

class PostController extends Controller
{
    protected object $sortService;

    public function __construct(SortService $sortService)
    {
        $this->sortService = $sortService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('index', ['posts' => Post::paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return View
     */
    public function show(Post $post): View
    {
        return view('post', ['post' => $post, 'comments' => $post->comments()->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function sortByCategory(Category $category): View
    {
        $posts = $this->sortService->sortByCategory($category)->paginate(5);

        return view('sort_by_category', ['posts' => $posts, 'category' => $category]);
    }
}
