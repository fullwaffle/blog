@extends('layouts.layout')

@section('main')
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to Blog Home!</h1>
            </div>
        </div>
    </header>

    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Featured blog post-->
                @if(count($posts) === 0)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title">No posts</h2>
                        </div>
                    </div>
                @else
                    @foreach($posts as $post)
                        @if($loop->first)
                            <div class="card mb-4">
                                <a href="{{ route('posts.show', ['post' => $post]) }}"><img class="card-img-top" src="{{ asset('assets/img/850x350.jpg') }}" alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted">Posted on {{ $post->created_at->format('F d, Y') }} by {{ $post->user->login }}</div>
                                    <h2 class="card-title">{{ $post->title }}</h2>
                                    <p class="card-text">{{ $post->description }}</p>
                                    <a class="btn btn-primary" href="{{ route('posts.show', ['post' => $post]) }}">Read more →</a>
                                </div>
                            </div>
                            <div class="row">
                        @if($loop->last)
                            </div>
                        @endif
                            @continue;
                        @endif

                        @if($loop->iteration % 4 === 0)
                            </div>
                            <div class="col-lg-6">
                                <!-- Blog post-->
                                <div class="card mb-4">
                                    <a href="{{ route('posts.show', ['post' => $post]) }}"><img class="card-img-top" src="{{ asset('assets/img/700x350.jpg') }}" alt="..." /></a>
                                    <div class="card-body">
                                        <div class="small text-muted">Posted on {{ $post->created_at->format('F d, Y') }} by {{ $post->user->login }}</div>
                                        <h2 class="card-title h4">{{ $post->title }}</h2>
                                        <p class="card-text">{{ $post->description }}</p>
                                        <a class="btn btn-primary" href="{{ route('posts.show', ['post' => $post]) }}">Read more →</a>
                                    </div>
                                </div>
                        @if($loop->last)
                            </div>
                            </div>
                        @endif
                            @continue;
                        @endif

                        @if($loop->even)
                            <div class="col-lg-6">
                                <!-- Blog post-->
                                <div class="card mb-4">
                                    <a href="{{ route('posts.show', ['post' => $post]) }}"><img class="card-img-top" src="{{ asset('assets/img/700x350.jpg') }}" alt="..." /></a>
                                    <div class="card-body">
                                        <div class="small text-muted">Posted on {{ $post->created_at->format('F d, Y') }} by {{ $post->user->login }}</div>
                                        <h2 class="card-title h4">{{ $post->title }}</h2>
                                        <p class="card-text">{{ $post->description }}</p>
                                        <a class="btn btn-primary" href="{{ route('posts.show', ['post' => $post]) }}">Read more →</a>
                                    </div>
                                </div>
                        @endif

                        @if($loop->odd)
                            <div class="card mb-4">
                                <a href="{{ route('posts.show', ['post' => $post]) }}"><img class="card-img-top" src="{{ asset('assets/img/700x350.jpg') }}" alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted">Posted on {{ $post->created_at->format('F d, Y') }} by {{ $post->user->login }}</div>
                                    <h2 class="card-title h4">{{ $post->title }}</h2>
                                    <p class="card-text">{{ $post->description }}</p>
                                    <a class="btn btn-primary" href="{{ route('posts.show', ['post' => $post]) }}">Read more →</a>
                                </div>
                            </div>
                        @endif

                        @if($loop->last)
                            </div>
                            </div>
                        @endif
                    @endforeach
                @endif

                <!-- Pagination-->
                {{ $posts->links() }}
            </div>
@endsection
