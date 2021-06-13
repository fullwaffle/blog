@extends('layouts.layout')

@section('page_title')
    {{ $post->title }}
@endsection

@section('main')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Posted on {{ $post->created_at->format('F d, Y') }} by {{ $post->user->login }}</div>
                        <!-- Post categories-->
                        @if(count($post->categories) === 0)
                            No categories
                        @else
                            @foreach($post->categories as $category)
                                <a class="badge bg-secondary text-decoration-none link-light" href="{{ route('posts.sortByCategory', $category->slug) }}">{{ $category->name }}</a>
                            @endforeach
                        @endif
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded" src="{{ asset('assets/img/900x400.jpg') }}" alt="..." /></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-4">{{ $post->body }}</p>
                    </section>
                </article>
                <!-- Comments section-->
                <section class="mb-5">
                    <div class="card bg-light">
                        <div class="card-body">
                            <!-- Comment form-->
                            @auth
                                <form class="mb-4" method="post" action="{{ route('comments.store') }}">
                                    @csrf
                                    <div class="form-group mb-1">
                                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                        <input class="form-control" name="comment_body" placeholder="Join the discussion and leave a comment!" type="text">
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-warning" value="Add Comment" type="submit">
                                    </div>
                                </form>
                            @else
                                <h2>Authorize to comment!</h2>
                            @endauth

                            @if(count($comments) === 0)
                                <h5>No comments</h5>
                            @else
                                @include('partials.comment_replies', ['comments' => $comments, 'post_id' => $post->id, 'margin' => 'mb-4'])
                            @endif

                        </div>
                    </div>
                </section>
            </div>

@endsection
