<?php


namespace App\Services;


use App\Models\Comment;
use App\Models\Post;

class CommentService
{
    protected object $comment;
    protected object $reply;
    protected object $post;

    public function __construct(Comment $comment, Post $post)
    {
        $this->comment = $comment;
        $this->reply = $comment;
        $this->post = $post;
    }

    public function storeComment(object $user, string $commentBody, int $postId): void
    {
        $this->comment->body = $commentBody;
        $this->comment->user()->associate($user);
        $this->post = $this->post->find($postId);

        $this->post->comments()->save($this->comment);
    }

    public function storeReply(object $user, string $commentBody, int $postId, int $commentId): void
    {
        $this->reply->body = $commentBody;
        $this->reply->user()->associate($user);
        $this->reply->parent_id = $commentId;
        $this->post = $this->post->find($postId);

        $this->post->comments()->save($this->reply);
    }
}
