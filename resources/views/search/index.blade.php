@extends('layouts.layout')

@section('main')
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Search</h1>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="card mb-4">
                <a href="{{ route('posts.show', ['post' => $post]) }}"><img class="card-img-top" src="{{ asset('assets/img/700x350.jpg') }}" alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted">Posted on {{ $post->created_at->format('F d, Y') }} by {{ $post->user->login }}</div>
                    <h2 class="card-title h4">{{ $post->title }}</h2>
                    <p class="card-text">{{ $post->description }}</p>
                    <a class="btn btn-primary" href="{{ route('posts.show', ['post' => $post]) }}">Read more →</a>
                </div>
            </div>
        @endforeach
    @else
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">No result found for "{{ $key }}"</h2>
            </div>
        </div>
    @endif

    {{ $posts->links() }}

            </div>
@endsection
