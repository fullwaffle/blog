<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    protected object $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function searchByPosts(Request $request): View
    {
        $key = trim($request->get('q'));

        $posts = $this->searchService->searchByPost($key);

        return view('search.index', [
            'key' => $key,
            'posts' => $posts,
        ]);
    }
}
