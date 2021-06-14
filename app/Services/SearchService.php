<?php


namespace App\Services;


use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchService
{
    protected object $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function searchByPost(mixed $key): LengthAwarePaginator
    {
        return $this->post->searchByPost($key)->withPath('/search?q=' . $key);
    }
}
